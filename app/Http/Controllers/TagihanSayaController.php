<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TagihanSayaController extends Controller
{
    public function indexSaya($id)
    {

        $myrelations = DB::table('tagihans')
            ->join('users', 'tagihans.user_id', '=', 'users.id')
            ->join('kelass', 'tagihans.kelas_id', '=', 'kelass.id')
            ->select([
                'tagihans.id', 'users.nama', 'tagihans.invoice', 'kelass.judulkelas', 'kelass.harga', 'tagihans.status', 'tagihans.foto'
            ])
            ->where('users.id', $id)
            ->where('status', '!=', 'Terbayar')
            ->where('status', '!=', 'Ditolak')
            ->latest('tagihans.created_at')
            ->get();




        $mydata = [
            'myrelations'   => $myrelations
        ];

        

        return view('components.menus.tagihansaya', $mydata);

    }
}
