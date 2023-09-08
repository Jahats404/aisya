<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akependudukan;
use App\Models\Apendidikan;
use App\Models\Apribadi;
use App\Models\Akesehatan;
use App\Models\Wilayah;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function dashboardA(){
        $id = Auth::user()->id;
        $countkependudukan = Akependudukan::where('user_id', $id)->count();
        $countpendidikan = Apendidikan::where('user_id', $id)->count();
        $countkesehatan = Akesehatan::where('user_id', $id)->count();
        $countpribadi = Apribadi::where('user_id', $id)->count();
        $kota = '33.01';
        //query untuk menampilkan seluruh nama di tabel wilayah dengan panjang kodenya 8
        $namaKecamatan = DB::table('wilayah')
                ->select('nama')
                ->where('kode', 'like', '%' . $kota . '%')
                // ->orderBy('nama', 'asc')
                ->WhereRaw('LENGTH(kode) = 8')
                ->get();
        $kodeKecamatan = DB::table('wilayah')
                ->select('kode')
                ->where('kode', 'like', '%' . $kota . '%')
                // ->orderBy('nama', 'asc')
                ->WhereRaw('LENGTH(kode) = 8')
                ->get();
                //query untuk menampilkan total
        $totalKecamatan = DB::table('wilayah')
                ->select('total')
                ->where('kode', 'like', '%' . $kota . '%')
                ->WhereRaw('LENGTH(kode) = 8')
                ->get();
        // dd($totalKecamatan);

        $namaDesa = DB::table('wilayah')
                ->select('nama')
                ->where('kode', 'like', '%' . $kota . '%')
                // ->orderBy('nama', 'asc')
                ->WhereRaw('LENGTH(kode) = 13')
                ->get();
                // dd($namaDesa);
                //query untuk menampilkan total
        $totalDesa = DB::table('wilayah')
                ->select('total')
                ->where('kode', 'like', '%' . $kota . '%')
                ->WhereRaw('LENGTH(kode) = 8')
                ->get();
        
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kota . '%')
                ->orderBy('nama', 'asc')
                ->WhereRaw('LENGTH(kode) = 13')
                ->get();

        $cekdesaa = '33.01.02';
        $cekdesa = DB::table('wilayah')
                ->select('nama')
                ->where('kode', 'like', '%' . $cekdesaa . '%')
                // ->orderBy('nama', 'asc')
                ->WhereRaw('LENGTH(kode) = 13')
                ->get();
// ========================================  MAPS   ========================================================================
// ========================================  MAPS   ========================================================================
        $cekJumlah = DB::table('wilayah')
                ->where('kode', 'like' , '%' . $kota . '%')
                ->whereRaw('length(kode) = 8')
                ->get();
        

        return view('admin.dashboard', compact('kodeKecamatan','totalKecamatan','totalDesa','namaDesa','countkependudukan','countpendidikan','countkesehatan','countpribadi','namaKecamatan','desa','cekJumlah'));
    }

    public function dashboardM(){
        $id = Auth::user()->id;
        $countkependudukan = Akependudukan::where('user_id', $id)->count();
        $countpendidikan = Apendidikan::where('user_id', $id)->count();
        $countkesehatan = Akesehatan::where('user_id', $id)->count();
        $countpribadi = Apribadi::where('user_id', $id)->count();
        return view('index', compact('countkependudukan','countpendidikan','countkesehatan','countpribadi'));
    }

    public function kode(Request $request){
        $kode = $request->kodeWilayah;
        
        $namaKecamatan = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKec = $namaKecamatan[0];
        $daftarDesa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->WhereRaw('LENGTH(kode) = 13')
                ->get();
                
        return view('datadesa',compact('namaKec','daftarDesa'));
    }

//  ==== DETAIL DESA ===== DETAIL DESA ===== DETAIL DESA ===== DETAIL DESA ===== DETAIL DESA ===== DETAIL DESA ===== DETAIL DESA ===== DETAIL DESA ===== DETAIL DESA ===== DETAIL DESA ===== DETAIL DESA ==================================================================================

    public function Adipala(){
        $kode = '33.01.03';
        //menampilkan data desa yang ada di kecamatan yang dipilih
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        //ambil nama kecamatan yang dipilih
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();

        $namaKecamatan = $ambilNama[0]->nama;

        return view('admin.data-desa', compact('desa','namaKecamatan'));
    }

    public function Kesugihan(){
        $kode = '33.01.02';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $cekJumlah = DB::table('wilayah')
                ->select('total')
                ->where('kode', $kode)
                ->get();
        
        $namaKecamatan = $ambilNama[0]->nama;
        $jumlah = $cekJumlah[0];
        
        return view('admin.data-desa', compact('desa','namaKecamatan','jumlah'));
    }

    public function Dayeuhluhur() {
        $kode = '33.01.16';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();

        $namaKecamatan = $ambilNama[0]->nama;

        return view('admin.data-desa', compact('desa','namaKecamatan'));
    }

    public function Wanareja() {
        $kode = '33.01.15';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }

    public function Majenang() {
        $kode = '33.01.14';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }

    public function Cimanggu() {
        $kode = '33.01.13';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }

    public function Cipari() {
        $kode = '33.01.18';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }
    
    public function Karangpucung() {
        $kode = '33.01.12';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }
    
    public function Sidareja() {
        $kode = '33.01.11';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }
    
    public function Kedungreja() {
        $kode = '33.01.01';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }
    
    public function Gandrungmangu() {
        $kode = '33.01.10';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }
    
    public function Patimuan() {
        $kode = '33.01.19';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }
    
    public function Bantarsari() {
        $kode = '33.01.20';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }

    public function Kampunglaut() {
        $kode = '33.01.24';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }
    
    public function Kawunganten() {
        $kode = '33.01.09';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }

    public function Jeruklegi() {
        $kode = '33.01.08';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }

    public function Cilacaptengah() {
        $kode = '33.01.22';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }

    public function Nusakambangan() {
        $kode = '33.01.22';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }

    public function Cilacaputara() {
        $kode = '33.01.23';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }

    public function Maos() {
        $kode = '33.01.07';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }

    public function Sampang() {
        $kode = '33.01.17';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }

    public function Kroya() {
        $kode = '33.01.06';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }

    public function Binangun() {
        $kode = '33.01.04';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }

    public function Nusawungu() {
        $kode = '33.01.05';
        $desa = DB::table('wilayah')
                ->where('kode', 'like', '%' . $kode . '%')
                ->whereRaw('length(kode) = 13')
                ->get();
        $ambilNama = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kode)
                ->get();
        $namaKecamatan = $ambilNama[0]->nama;
        
        return view('admin.data-desa', compact('desa', 'namaKecamatan'));
    }

// ========================================  TOTAL MASYARAKAT   ========================================================================
// ========================================  TOTAL MASYARAKAT   ========================================================================

    public function totMasyarakat() {
        $masyarakat = User::get();
        return view('admin.daftar-masyarakat', compact('masyarakat'));
    }
    
}
