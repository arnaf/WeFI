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


            'members'     => $members,
            'kelases'     => $kelases,

        ];

        return view('components.menus.pendaftaran', $data);
    }


    public function index()
    {
        $tagihans= DB::table('tagihans')->get();

        $data = [
            'tagihans'    => $tagihans,
        ];

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

        if($request == NULL) {
            $json = [
                'msg'       => 'Mohon masukan data member',
                'status'    => false
            ];

        } if($request->invoiceMember == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nomor invoice',
                'status'    => false
            ];

        } elseif($request->namaMember == NULL){
            $json = [
                'msg'       => 'Mohon masukan nama member',
                'status'    => false
            ];
        } elseif($request->alamatMember == NULL){
            $json = [
                'msg'       => 'Mohon masukan alamat member',
                'status'    => false
            ];
        } elseif($request->kelasMember == NULL) {
            $json = [
                'msg'       => 'Mohon masukan kelas member',
                'status'    => false
            ];
        } elseif($request->namaPengajar == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama pengajar',
                'status'    => false
            ];
        } elseif($request->biayaKelas == NULL) {
            $json = [
                'msg'       => 'Mohon masukan biaya kelas',
                'status'    => false
            ];
        } elseif($request->metodeMember == NULL) {
            $json = [
                'msg'       => 'Mohon masukan metode pembayaran member',
                'status'    => false
            ];
        }
        else {
            try{

                DB::transaction(function() use($request) {
                    $tagihan = Tagihan::create([
                        'invoice'      => $request->invoiceMember,
                        'user_id'      => $request->namaMember,
                        'kelas_id'     => $request->kelasMember,
                        'status'       => "Belum dibayar",
                        'metode'       => $request->metodeMember,
                        'created_at'   => date('Y-m-d H:i:s')
                    ]);


                });

                $json = [
                    'msg' => 'Tagihan berhasil ditambahkan',
                    'status' => true
                ];
            } catch(Exception $e) {
                $json = [
                    'msg'       => 'error',
                    'status'    => false,
                    'e'         => $e
                ];
            }
        }
        return Response::json($json);
    }


}
