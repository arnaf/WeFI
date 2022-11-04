<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Tagihan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\RiwayatPembayaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class TagihanController extends Controller
{
    public function indexDaftar() {

        $invoice = uniqid();
        $members = DB::table('users')->where('id', '>', 2)->get();
        $kelases = DB::table('kelass')->get();


        $data = [

            'invoice'     => $invoice,
            'members'     => $members,
            'kelases'     => $kelases,

        ];






        return view('components.menus.pendaftaran', $data);
    }


    public function index()
    {

        $relations = DB::table('tagihans')
            ->join('users', 'tagihans.user_id', '=', 'users.id')
            ->join('kelass', 'tagihans.kelas_id', '=', 'kelass.id')
            ->select([
                'tagihans.id', 'users.nama', 'tagihans.invoice', 'kelass.judulkelas', 'kelass.harga', 'tagihans.status', 'tagihans.foto'
            ])
            ->where('status', '!=', 'Terbayar')
            ->where('status', '!=', 'Ditolak')
            ->latest('tagihans.created_at')
            ->get();




        $data = [
            'relations'   => $relations
        ];

        return view('components.menus.tagihan', $data);

    }


    public function indexHistorySuccess()
    {

        $relations = DB::table('tagihans')
            ->join('users', 'tagihans.user_id', '=', 'users.id')
            ->join('kelass', 'tagihans.kelas_id', '=', 'kelass.id')
            ->select([
                'tagihans.id', 'users.nama', 'tagihans.invoice', 'kelass.judulkelas', 'kelass.harga', 'tagihans.status', 'tagihans.foto'
            ])
            ->where('status', 'Terbayar')
            ->latest('tagihans.created_at')
            ->get();

        $data = [
            'relations'   => $relations
        ];

        // $relations = DB::table('tagihans')
        //     ->join('users', 'tagihans.user_id', '=', 'users.id')
        //     ->join('kelass', 'tagihans.kelas_id', '=', 'kelass.id')
        //     ->select([
        //         'tagihans.id', 'users.nama', 'tagihans.invoice', 'kelass.judulkelas', 'kelass.harga', 'tagihans.status', 'tagihans.foto'
        //     ])
        //     ->where('status', '!=', 'Terbayar')
        //     ->where('status', '!=', 'Ditolak')
        //     ->latest('tagihans.created_at')
        //     ->get();


        return view('components.menus.riwayatsuccess', $data);

    }

    public function indexHistoryFail()
    {

        $relations = DB::table('tagihans')
            ->join('users', 'tagihans.user_id', '=', 'users.id')
            ->join('kelass', 'tagihans.kelas_id', '=', 'kelass.id')
            ->select([
                'tagihans.id', 'users.nama', 'tagihans.invoice', 'kelass.judulkelas', 'kelass.harga', 'tagihans.status', 'tagihans.foto'
            ])
            ->where('status', 'Ditolak')
            ->latest('tagihans.created_at')
            ->get();

        $data = [
            'relations'   => $relations
        ];

        return view('components.menus.riwayatfail', $data);

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
                // $tagihan = Tagihan::orderBy('created_at', 'desc')
                // ->take(10)
                // ->get();

            $relations = DB::table('tagihans')
            ->join('users', 'tagihans.user_id', '=', 'users.id')
            ->join('kelass', 'tagihans.kelas_id', '=', 'kelass.id')
            ->select([
                'tagihans.id', 'users.nama', 'tagihans.invoice', 'kelass.judulkelas', 'kelass.harga', 'tagihans.status', 'tagihans.foto'
            ])
            ->latest('tagihans.created_at')
            ->get();




        $data = [
            'relations'   => $relations
        ];

        if(Auth::user()->id == 1){
            return redirect()->to('/tagihan');
        } else {
            return redirect()->to( route('tagihansaya', Auth::user()->id) );
        }
    }


    public function verificationSuccess($id) {

        DB::transaction(function() use($id) {
            Tagihan::where('id', $id)
            ->update([
                'status' => 'Terbayar'
            ]);
        });



        return redirect()->to('/success');
    }


    public function verificationFail($id) {

        DB::transaction(function() use($id) {
            Tagihan::where('id', $id)
            ->update([
                'status' => 'Ditolak'
            ]);
        });

        return redirect()->to('/fail');
    }

    public function uploadBukti(Request $request, $id){



        if($request->hasFile('foto')){
            $extension = $request->file('foto')->getClientOriginalExtension();

            $foto = date('YmdHis').'.'.$extension;


            $path = base_path('public/assets/images/bukti');

            $request->file('foto')->move($path, $foto);

            DB::transaction(function() use($foto, $id) {
                Tagihan::where('id', $id)
                ->update([

                    'status' => 'Dalam verifikasi Admin',
                    'foto'  => $foto

                ]);

            });
        }
        
        if(Auth::user()->id == 1){
        return redirect()->to('/tagihan');
        } else {
            return redirect()->to( route('tagihansaya', Auth::user()->id) );
        }

    }
}
