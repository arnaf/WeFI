<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatSaya extends Controller
{
    public function myindexHistorySuccess($id)
    {

        $relationssukses = DB::table('tagihans')
            ->join('users', 'tagihans.user_id', '=', 'users.id')
            ->join('kelass', 'tagihans.kelas_id', '=', 'kelass.id')
            ->select([
                'tagihans.id', 'users.nama', 'tagihans.invoice', 'kelass.judulkelas', 'kelass.harga', 'tagihans.status', 'tagihans.foto'
            ])
            ->where('users.id', $id)
            ->where('status', 'Terbayar')
            ->latest('tagihans.created_at')
            ->get();

        $data = [
            'relationssukses'   => $relationssukses
        ];
        return view('components.menus.riwayatsuksessaya', $data);

    }

    public function myindexHistoryFail($id)
    {

        $relationsgagal = DB::table('tagihans')
            ->join('users', 'tagihans.user_id', '=', 'users.id')
            ->join('kelass', 'tagihans.kelas_id', '=', 'kelass.id')
            ->select([
                'tagihans.id', 'users.nama', 'tagihans.invoice', 'kelass.judulkelas', 'kelass.harga', 'tagihans.status', 'tagihans.foto'
            ])
            ->where('users.id', $id)
            ->where('status', 'Ditolak')
            ->latest('tagihans.created_at')
            ->get();

        $data = [
            'relationsgagal'   => $relationsgagal
        ];

        return view('components.menus.riwayatfailsaya', $data);

    }
}
