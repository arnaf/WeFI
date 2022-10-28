<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class TagihanController extends Controller
{
    public function indexDaftar() {

        $invoice = uniqid();
        $members = DB::table('users')->where('id', '>', 2)->get();
        $kelases = DB::table('kelass')->get();

        $data = [

            'invoice'     => uniqid(),
            'members'     => $members,
            'kelases'     => $kelases,

        ];

    

        return view('components.menus.pendaftaran', $data);
    }


    public function index()
    {

        $relations = DB::table('tagihans')
        ->leftjoin('users', 'tagihans.user_id', '=', 'users.id')
        ->leftJoin('kelass', 'tagihans.kelas_id', '=', 'kelass.id')
        ->get();


        $data = [
            'relations'   => $relations
        ];
        dd($relations);
        return view('components.menus.tagihan', $data);

    }


    public function show($id) {


        if(is_numeric($id)) {
            $data = Tagihan::where('id', $id)->first();

            return Response::json($data);
        }

        $data = DB::table('tagihans')
            ->leftjoin('users', 'tagihans.user_id', '=', 'users.id')
            ->leftJoin('kelass', 'tagihans.kelas_id', '=', 'kelass.id')
            ->get();

        return DataTables::of($data)

            ->addColumn(
                'action',
                function($row) {
                    $data = [
                        'id' => $row->id,
                    ];

                    return view('components.buttons.tagihan', $data);
                }
            )
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {


            DB::transaction(function () use ($request) {
                Tagihan::create([

                'invoice'         => $request->invoiceMember,
                'user_id'         => $request->namaMember,
                'kelas_id'        => $request->kelasMember,
                'metode'          => $request->metodeMember,
                'status'          => 'Belum dibayar',
                'created_at'      => date('Y-m-d H:i:s')
                ]);

            });

    }


}
