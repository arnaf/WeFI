<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    public function namaMember(Request $request) {

        $namaMembers = DB::table('users')->where('id', $request->id)->first();

        return response()->json($namaMembers);
    }

    public function kelasMember(Request $request) {

        $kelasMembers = DB::table('kelass')->where('id', $request->id)->first();

        return response()->json($kelasMembers);
    }
}
