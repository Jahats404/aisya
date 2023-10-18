<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Akesehatan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AkesehatanController extends Controller
{
    public function form_arkes(){
        $kategori = Kategori::all();
        return view('arkes',compact('kategori'));
    }

    public function arkes_store(Request $request)
    {
        $validator = Validator::make($request->all(), Akesehatan::$rules, Akesehatan::$messages);
        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        };
        try {
    
            $image = $request->file('image');
            $originalName = $image->getClientOriginalName();
            $hashName = $image->hashName();
            // Simpan gambar ke direktori yang diinginkan (misalnya: storage/app/public/images)
            $path = $image->store('public/img-arkes');
            // Dapatkan URL gambar yang diunggah
            $url = asset('storage/img-arkes/' . $hashName);
            // Kode Otomatis
            $kesehatan = Akesehatan::all();
            $LastKesehatan = Akesehatan::orderBy('id_arkes','desc')->first();
            $newIdKesehatan = $LastKesehatan ? (int) substr($LastKesehatan->id_arkes,1) + 1 : 1;
            $newIdFormat = 'K'. str_pad($newIdKesehatan,3,'0', STR_PAD_LEFT);

            //id masyarakat
            $id = Auth::user()->id;
            // ambil data kk dari user yang login
            $userKK = DB::table('users')
                    ->select('kk')
                    ->where('id', $id)
                    ->get();
            $kk = $userKK[0]->kk;
            // Tambahkan data ke tabel arsip_pendidikan
            $arkes = new Akesehatan;
            $arkes->user_id = $id;
            $arkes->kategori = $request->input('kategori');
            $arkes->nama_arkes = $originalName;
            $arkes->deskripsi_arkes = $request->input('deskripsi_arkes');
            $arkes->url = $url;
            $arkes->hashname = $hashName;
            $arkes->kk = $kk;
            // $arkes->tanggal_upload = $request->input('tanggal_upload');
            $arkes->save();
    
            return redirect()->back()->with('success', 'Data berhasil di Upload');
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', 'Data gagal di Upload');
        }
        // Validasi input
        
    }

    public function table_arkes(){
        $id = Auth::user()->id;
        // tampilkan arsip berdasarkan kk yang sama
        $userKK = DB::table('users')
                ->select('kk')
                ->where('id', $id)
                ->get();
        $kk = $userKK[0]->kk;
        $arkes = Akesehatan::where('kk', $kk)->get();
        return view('table-arkes',compact('arkes'));
    }

    public function update_arkes(Request $request, $id_arkes){
    
        $arsip = Akesehatan::findOrFail($id_arkes);
        $arsip->kategori = $request->input('kategori');
        $arsip->deskripsi_arkes = $request->input('deskripsi_arkes');
        $arsip->save();
    
        return redirect()->back()->with('success', 'Arsip berhasil diperbarui.');
        }

    public function destroy($id_arkes){
    $arsip = Akesehatan::findOrFail($id_arkes);
    if (!empty($arsip->url)) {
        Storage::delete('public/img-arkes/' . $arsip->hashname);
        
    }
    $arsip->delete();

    return redirect()->back()->with('success', 'Arsip berhasil dihapus.');
    }
}
