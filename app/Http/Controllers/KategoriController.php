<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;


class KategoriController extends Controller
{
    public function index()
    {
        $kategoris= DB::table('kategoris')->get();

        $data = [
            // 'roles'    => $users,
            'script'   => 'components.scripts.kategori'
        ];

        return view('components.menus.kategori', $data);

    }


    public function show($id) {


        if(is_numeric($id)) {
            $data = Kategori::where('id', $id)->first();
            return Response::json($data);
        }

        $data = Kategori::latest('kategoris.created_at')
        ->get();

        return DataTables::of($data)

            ->addColumn(
                'action',
                function($row) {
                    $data = [
                        'id' => $row->id,
                        'nama' => $row->nama,
                    ];

                    return view('components.buttons.kategori', $data);
                }
            )
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {


        if($request == NULL) {
            $json = [
                'msg'       => 'Mohon masukan data kategori kelas',
                'status'    => false
            ];

        } if($request->kategori == NULL) {
            $json = [
                'msg'       => 'Mohon masukan data kategori kelas',
                'status'    => false
            ];
        }
        else {
            try{

                DB::transaction(function() use($request) {
                    $kategori = Kategori::create([
                        'nama'         => $request->kategori,
                        'created_at'    => date('Y-m-d H:i:s')
                    ]);

                });

                $json = [
                    'msg' => 'Kategori berhasil ditambahkan',
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

        if($request == NULL) {
            $json = [
                'msg'       => 'Mohon masukan data kategori kelas',
                'status'    => false
            ];

        } if($request->kategoriEdit == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama kategori kelas',
                'status'    => false
            ];
        } else {
            try{

              DB::transaction(function () use ($request, $id) {
                $oldKategori = Kategori::where('id', $id)->first();

                $kategori = Kategori::where('id', $id)->update([
                    'nama'         => $request->kategoriEdit,
                    'updated_at'   => date('Y-m-d H:i:s')
                ]);
            });

                $json = [
                    'msg' => 'Data kategori kelas berhasil diubah',
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
                  DB::table('kategoris')->where('id', $id)->delete();
              });

                $json = [
                    'msg' => 'Data Kategori berhasil dihapus',
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
