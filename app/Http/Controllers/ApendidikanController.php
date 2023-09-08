<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Apendidikan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApendidikanController extends Controller
{
    public function form_arpen(){
        $kategori = Kategori::all();
        return view('arpen',compact('kategori'));
    }

    public function arpen_store(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpeg,png,jpg,pdf|max:2048|required',
            'kategori' => 'required',
        ]);
        // try {
    
            $image = $request->file('image');
            $originalName = $image->getClientOriginalName();
            $hashName = $image->hashName();
            // Simpan gambar ke direktori yang diinginkan (misalnya: storage/app/public/images)
            $path = $image->store('public/img-arpen');
            
            // Dapatkan URL gambar yang diunggah
            $url = asset('storage/img-arpen/' . $hashName);
            
            // Kode Otomatis
            $pendidikan = Apendidikan::all();
            $LastPendidikan = Apendidikan::orderBy('id_arpen','desc')->first();
            $newIdPendidikan = $LastPendidikan ? (int) substr($LastPendidikan->id_arpen,1) + 1 : 1;
            $newIdFormat = 'P'. str_pad($newIdPendidikan,3,'0', STR_PAD_LEFT);
            
            // ID Masyarakat
            $id = Auth::user()->id;
            // untuk mengambil data kk user yan login
            $userKK = DB::table('users')
                    ->select('kk')
                    ->where('id', $id)
                    ->get();
            $kk = $userKK[0]->kk;
            

            // Tambahkan data ke tabel arsip_pendidikan
            $arpen = new Apendidikan;
            $arpen->id_arpen = $newIdFormat;
            $arpen->user_id = $id;
            $arpen->kategori = $request->input('kategori');
            $arpen->nama_arpen = $originalName;
            $arpen->deskripsi_arpen = $request->input('deskripsi_arpen');
            $arpen->url = $url;
            $arpen->hashname = $hashName;
            $arpen->kk = $kk;
            // $arpen->tanggal_upload = $request->input('tanggal_upload');
            $arpen->save();
    
            return redirect()->back()->with('success', 'Data berhasil di Upload');
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with('fail', 'Data gagal di Upload');
        // }
        // Validasi input
        
    }

    public function table_arpen(){
        $id = Auth::user()->id;
        // tampilkan arsip berdasarkan kk yang sama
        $userKK = DB::table('users')
                ->select('kk')
                ->where('id', $id)
                ->get();
        $kk = $userKK[0]->kk;
        $arpen = Apendidikan::where('kk', $kk)->get();
        return view('table-arpen',compact('arpen'));
    }

    public function update_arpen(Request $request, $id_arpen){
    $request->validate([
        'nama_arpen' => 'required',
        'deskripsi_arpen' => 'required',
    ]);

    $arsip = Apendidikan::findOrFail($id_arpen);
    $arsip->nama_arpen = $request->input('nama_arpen');
    $arsip->deskripsi_arpen = $request->input('deskripsi_arpen');
    $arsip->save();

    return redirect()->back()->with('success', 'Arsip berhasil diperbarui.');
    }

    public function destroy($id_arpen){
    $arsip = Apendidikan::findOrFail($id_arpen);
    // $hashName = $image->hashName();
    // dd(('public/storage/img-arpen/' . $arsip->hashname));
    if (!empty($arsip->url)) {
        Storage::delete('public/img-arpen/' . $arsip->hashname);
        
    }
    $arsip->delete();

    return redirect()->back()->with('success', 'Arsip berhasil dihapus.');
    }

}
