<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WilayahController extends Controller
{
    public function getStates($id){

        $states = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $id)
                ->where('like', '%' . $id . '%')
                ->WhereRaw('Length(kode) = 13')
                ->get();
        return response()->json($states);
    }
}
