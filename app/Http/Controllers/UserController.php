<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wilayah;
use App\Models\Apendidikan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Apribadi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register()
    {

        $kota = '33.01';
        $kecamatan = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kota . '%')
                ->orderBy('nama', 'asc')
                ->WhereRaw('LENGTH(kode) = 8')
                ->get();
        
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kota . '%')
                ->orderBy('nama', 'asc')
                ->WhereRaw('LENGTH(kode) = 13')
                ->get();
        
                
        
        return view('register',compact('kecamatan','desa'));
    }
    
    public function actionregister(Request $request)
    {

        $validator = Validator::make($request->all(), User::$rules, User::$messages);
        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        //untuk mengambil kode desa yang di inputkan
        $kodeDesa = $request->desa;
        $kodeKecamatan = $request->kecamatan;
        
        //untuk mengubah setiap wilayah jika total NULL akan di ubah menjadi 0
        $ubahNull = DB::table('wilayah')
                ->where('kode', 'like', '%' . '33.01' . '%')
                ->where('total', NULL)
                ->update(['total' => 0]);

        //mengecek total masyarakat mendaftar di desa tersebut
        $showTotalkec = DB::table('wilayah')
                ->where('kode', $kodeKecamatan)
                ->get();

        //mengecek total masyarakat mendaftar di desa tersebut
        $showTotaldes = DB::table('wilayah')
                ->where('kode', $kodeDesa)
                ->get();
        //menambah jumlah total desa
        $totalafterDes = $showTotaldes[0]->total + 1;
        //menambah jumlah total kecamatan
        $totalafterKec = $showTotalkec[0]->total + 1;
        
        //untuk mengupdate data total dari kecamatan
        $updateTotalKec = DB::table('wilayah')
                ->where('kode', $kodeKecamatan)
                ->update(['total' => $totalafterKec]);
        //untuk mengupdate data total dari desa
        $updateTotalDes = DB::table('wilayah')
                ->where('kode', $kodeDesa)
                ->update(['total' => $totalafterDes]);
        

        // mengambil nama kecamatan berdasarkan kode
        $namakecamatan = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kodeKecamatan)
                ->get();
        // mengambil nama kecamatan berdasarkan kode
        $namaDesa = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kodeDesa)
                ->get();
        
        


        $user = User::create([
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nik' => $request->nik,
            'kk' => $request->kk,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
            'kecamatan' => $namakecamatan[0]->nama,
            'desa' => $namaDesa[0]->nama,
            'remember_token' => Str::random(60),
        ]);

        Session::flash('sukses', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan username dan password.');
        return redirect('register');
    }

    public function profile(){
        $user = Auth::user();
        return view('profile',compact('user'));
    }

    public function update_profile(Request $request){
        $request->validate([
            'name' => 'required',
            
        ]);

        // $arsip = Apendidikan::findOrFail($id_arpen);
        $profile = User::findOrFail(Auth::user()->id);
        $profile->name = $request->input('name');
        $profile->tanggal_lahir = $request->input('tanggal_lahir');
        $profile->nik = $request->input('nik');
        $profile->kk = $request->input('kk');
        $profile->no_hp = $request->input('no_hp');
        $profile->email = $request->input('email');
        $profile->save();
    
        return redirect()->back()->with('success', 'Profile berhasil diperbarui.');
    }
    
//============================================================================================================

    public function update_password(Request $request)
    {
        // Validasi input
        // $request->validate([
            //     'current_password' => 'required',
            //     'new_password' => 'required|min:8|confirmed',
            // ]);
            
            // Ambil user saat ini yang sedang login
        $user = User::findOrFail(Auth::user()->id);

        // Periksa apakah password lama sesuai dengan yang ada di database
        if (Hash::check($request->current_password, $user->password)) {
            // Jika password lama sesuai, ubah password baru
            if ($request->new_password == $request->konfirmasi_password) {
                $user->update([
                    'password' => Hash::make($request->new_password)
                ]);
            } else {
                return redirect()->back()->with('error', 'Konfirmasi Password salah.');
            }

            return redirect()->back()->with('success', 'Password berhasil diubah.');
        } else {
            return redirect()->back()->with('error', 'Password lama tidak sesuai.');
        }
    }

    public function update_fotodir(Request $request){
        
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $user = User::findOrFail(Auth::user()->id);

            // Hapus foto profil lama jika ada
            if ($user->url) {
                Storage::delete($user->url);
                Storage::delete('public/img-profile/' . $user->hashname);
            }

            $image = $request->file('image');
            $hashName = $image->hashName();

            // Simpan foto profile
            $path = $image->store('public/img-profile');
            // Upload foto profil baru
            // $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $url = asset('storage/img-profile/' . $hashName);
            $user->url = $url;
            $user->hashname = $hashName;
            $user->save();

            return redirect()->back()->with('success', 'Foto profil berhasil diunggah.');
        }
        return redirect()->back()->with('error', 'Gagal mengunggah foto profil.');
    }

    public function update_foto(Request $request)
    {
        $photoData = $request->input('photo');
        // dd($photoData);

        if ($photoData) {
            // Menghapus header "data:image/jpeg;base64," dari data gambar
            $photoData = substr($photoData, strpos($photoData, ',') + 1);
            // Mendekripsi data gambar dari Base64 ke binary
            $decodedData = base64_decode($photoData);
            
            // Nama file yang akan disimpan (misalnya, timestamp untuk menghindari duplikasi nama file)
            $randomfilename = Str::random(10);
            $fileName = $randomfilename . '.jpg';
            
            // Hapus foto profile lama jika ada
            $user = User::findOrFail(Auth::user()->id);
            if ($user->url) {
                Storage::delete($user->url);
                Storage::delete(('public/img-profile/' . $user->hashname));
            }

            // Lokasi direktori untuk menyimpan file gambar (pastikan direktori sudah ada dan dapat ditulisi)
            $uploadPath = public_path('storage/img-profile/');
            $url = asset('storage/img-profile/' . $fileName);
            
            // Simpan file gambar ke direktori yang ditentukan
            file_put_contents($uploadPath . $fileName, $decodedData);

            // Menyimpan ke database
            $user->url = $url;
            $user->hashname = $fileName;
            $user->save();

            // Lakukan sesuatu dengan data gambar yang sudah disimpan (misalnya, menyimpan nama file ke database)

            return redirect()->back()->with('success', 'Foto berhasil diunggah.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah foto.');
    }

    public function getkecamatan(Request $request){

        $idkecamatan = $request->idkecamatan;
        // dd($idkecamatan);
        $desa = Wilayah::where('kode', 'like' , '%' . $idkecamatan . '%')
                ->WhereRaw('LENGTH(kode) = 13')
                ->get();

        foreach ($desa as $item) {
            echo  "<option value='$item->kode'>$item->nama</option>";
        }
    }

}
