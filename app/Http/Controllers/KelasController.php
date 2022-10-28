<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index()
    {
        $Kategorikelas = DB::table('kategoris')->get();

        $data = [

            'KategoriKelas'     => $Kategorikelas,
            'script'            => 'components.scripts.kelas'
        ];

        return view('components.menus.kelas', $data);

    }

    public function show($id) {


        if(is_numeric($id)) {
            $data = Kelas::where('id', $id)->first();

            return Response::json($data);
        }

        $data = DB::table('kelass')
            ->join('kategoris', 'kelass.kategori_id', '=', 'kategoris.id')
            ->select([
                'kelass.*', 'kategoris.nama as kategorikelas'
            ])
            ->orderBy('kelass.id', 'desc');

        return DataTables::of($data)
                ->editColumn(
                    'gambar',
                    function($row) {
                        $data = [
                            'gambar' => $row->gambar
                        ];

                        return view('components.photo.kelas', $data);
                    }
                )
            ->addColumn(
                'action',
                function($row) {
                    $data = [
                        'id' => $row->id,
                    ];

                    return view('components.buttons.kelas', $data);
                }
            )
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {

        if($request->hasFile('gambar')){
        $extension = $request->file('gambar')->getClientOriginalExtension();

        $gambar = date('YmdHis').'.'.$extension;


        $path = base_path('public/photos');

        $request->file('gambar')->move($path, $gambar);
        }
        if($request == NULL) {
            $json = [
                'msg'       => 'Mohon masukan data kelas',
                'status'    => false
            ];

        } if($request->judulkelas == NULL) {
            $json = [
                'msg'       => 'Mohon masukan judul kelas',
                'status'    => false
            ];

        } elseif($request->gambar == NULL){
            $json = [
                'msg'       => 'Mohon masukan gambar kelas',
                'status'    => false
            ];
        } elseif($request->kode == NULL){
            $json = [
                'msg'       => 'Mohon masukan kode kelas',
                'status'    => false
            ];
        } elseif($request->kategorikelas == NULL) {
            $json = [
                'msg'       => 'Mohon masukan kategori kelas',
                'status'    => false
            ];
        } elseif($request->pengajar == NULL) {
            $json = [
                'msg'       => 'Mohon masukan pengajar kelas',
                'status'    => false
            ];
        } elseif($request->harga == NULL) {
            $json = [
                'msg'       => 'Mohon masukan harga kelas per bulan',
                'status'    => false
            ];
        } elseif($request->deskripsi == NULL) {
            $json = [
                'msg'       => 'Mohon masukan deskripsi kelas',
                'status'    => false
            ];
        }
        else {
            try{
                DB::transaction(function() use($request, $gambar) {
                    Kelas::create([
                        'gambar'       => $gambar,
                        'kode'         => $request->kode,
                        'judulkelas'         => $request->judulkelas,
                        'kategori_id'  => $request->kategorikelas,
                        'pengajar'     => $request->pengajar,
                        'harga'        => $request->harga,
                        'deskripsi'    => $request->deskripsi,
                        'created_at'   => date('Y-m-d H:i:s')
                    ]);

                });

                $json = [
                    'msg' => 'Data kelas berhasil ditambahkan',
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

    public function edit(Request $request, $id)
    {
        if($request->hasFile('gambarEdit')){
        $extension = $request->file('gambarEdit')->getClientOriginalExtension();

        $gambarEdit = date('YmdHis').'.'.$extension;

        $path = base_path('public/photos');

        $request->file('gambarEdit')->move($path, $gambarEdit);
        }
        if($request == NULL) {
            $json = [
                'msg'       => 'Mohon masukan data member',
                'status'    => false
            ];

        } if($request->judulkelasEdit == NULL) {
            $json = [
                'msg'       => 'Mohon masukan judul kelas',
                'status'    => false
            ];

        } elseif($request->gambarEdit == NULL){
            $json = [
                'msg'       => 'Mohon masukan gambar kelas',
                'status'    => false
            ];
        } elseif($request->kodeEdit == NULL){
            $json = [
                'msg'       => 'Mohon masukan kode kelas',
                'status'    => false
            ];
        } elseif($request->kategorikelasEdit == NULL) {
            $json = [
                'msg'       => 'Mohon masukan kategori kelas',
                'status'    => false
            ];
        } elseif($request->pengajarEdit == NULL) {
            $json = [
                'msg'       => 'Mohon masukan pengajar kelas',
                'status'    => false
            ];
        } elseif($request->hargaEdit == NULL) {
            $json = [
                'msg'       => 'Mohon masukan harga kelas per bulan',
                'status'    => false
            ];
        } elseif($request->deskripsiEdit == NULL) {
            $json = [
                'msg'       => 'Mohon masukan deskripsi kelas',
                'status'    => false
            ];
        } else {
            try{

              DB::transaction(function () use ($request, $id, $gambarEdit) {
                // $oldKelas = User::where('id', $id)->first();

                // $oldUser->roles()->detach();


                $kelas = Kelas::where('id', $id)->update([
                    'gambar'       => $gambarEdit,
                    'kode'         => $request->kodeEdit,
                    'judulkelas'         => $request->judulkelasEdit,
                    'kategori_id'  => $request->kategorikelasEdit,
                    'pengajar'     => $request->pengajarEdit,
                    'harga'        => $request->hargaEdit,
                    'deskripsi'    => $request->deskripsiEdit,
                    'updated_at'   => date('Y-m-d H:i:s')
                ]);

            });

                $json = [
                    'msg' => 'Data kelas berhasil diubah',
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

    public function destroy($id)
    {

            try{

              DB::transaction(function() use($id) {
                  DB::table('kelass')->where('id', $id)->delete();
              });

                $json = [
                    'msg' => 'Data kelas berhasil dihapus',
                    'status' => true
                ];
            } catch(Exception $e) {
                $json = [
                    'msg'       => 'error',
                    'status'    => false,
                    'e'         => $e
                ];
            }


        return Response::json($json);
    }
}
