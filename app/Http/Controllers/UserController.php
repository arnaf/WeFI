<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $users= DB::table('users')->get();

        $data = [
            'roles'    => $users,
            'script'   => 'components.scripts.user'
        ];

        return view('components.menus.user', $data);

    }

    public function show($id) {


        if(is_numeric($id)) {
            $data = User::where('id', $id)->first();
            return Response::json($data);
        }

        $data = User::where('id', '!=', 1)->get();

        return DataTables::of($data)

            ->addColumn(
                'action',
                function($row) {
                    $data = [
                        'id' => $row->id,
                        'nama' => $row->nama,
                        'tgl_lhr' => $row->tgl_lhr,
                        'tmp_lhr' => $row->tmp_lhr,
                        'pendidikan' => $row->pendidikan,
                        'alamat' => $row->alamat,
                    ];

                    return view('components.buttons.user', $data);
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

        } if($request->nama == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama member',
                'status'    => false
            ];

        } elseif($request->email == NULL){
            $json = [
                'msg'       => 'Mohon masukan email member',
                'status'    => false
            ];
        } elseif(strpos($request->email, '@') == false ){
            $json = [
                'msg'       => 'Mohon masukan format email',
                'status'    => false
            ];
        }
         elseif($request->password == NULL){
            $json = [
                'msg'       => 'Mohon masukan password member',
                'status'    => false
            ];
        } elseif($request->tgl_lhr == NULL) {
            $json = [
                'msg'       => 'Mohon masukan tanggal lahir member',
                'status'    => false
            ];
        } elseif($request->tmp_lhr == NULL) {
            $json = [
                'msg'       => 'Mohon masukan tempat lahir member',
                'status'    => false
            ];
        } elseif($request->alamat == NULL) {
            $json = [
                'msg'       => 'Mohon masukan alamat member',
                'status'    => false
            ];
        } elseif($request->pendidikan == NULL) {
            $json = [
                'msg'       => 'Mohon masukan pendidikan terakhir member',
                'status'    => false
            ];
        }
        else {
            try{

                DB::transaction(function() use($request) {
                    $user = User::create([
                        'email'         => $request->email,
                        'password'      => Hash::make($request->password),
                        'nama'         => $request->nama,
                        'tgl_lhr'      => $request->tgl_lhr,
                        'tmp_lhr'      => $request->tmp_lhr,
                        'pendidikan'   => $request->pendidikan,
                        'alamat'       => $request->alamat,
                        'created_at'    => date('Y-m-d H:i:s')
                    ]);
                    $user->syncRoles('member');


                });

                $json = [
                    'msg' => 'Member berhasil ditambahkan',
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
                'msg'       => 'Mohon masukan data member',
                'status'    => false
            ];

        } if($request->namaEdit == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama member',
                'status'    => false
            ];

        }  elseif($request->tgl_lhrEdit == NULL) {
            $json = [
                'msg'       => 'Mohon masukan tanggal lahir member',
                'status'    => false
            ];
        } elseif($request->tmp_lhrEdit == NULL) {
            $json = [
                'msg'       => 'Mohon masukan tempat lahir member',
                'status'    => false
            ];
        } elseif($request->alamatEdit == NULL) {
            $json = [
                'msg'       => 'Mohon masukan alamat member',
                'status'    => false
            ];
        } elseif($request->pendidikanEdit == NULL) {
            $json = [
                'msg'       => 'Mohon masukan pendidikan terakhir member',
                'status'    => false
            ];
        } else {
            try{

              DB::transaction(function () use ($request, $id) {
                $oldUser = User::where('id', $id)->first();

                $oldUser->roles()->detach();

                if($request->passwordEdit !== null){
                $user = User::where('id', $id)->update([
                    'nama'         => $request->namaEdit,
                    'password'     => Hash::make($request->passwordEdit),
                    'tgl_lhr'      => $request->tgl_lhrEdit,
                    'tmp_lhr'      => $request->tmp_lhrEdit,
                    'pendidikan'   => $request->pendidikanEdit,
                    'alamat'       => $request->alamatEdit,
                    'updated_at'   => date('Y-m-d H:i:s')
                ]);
                } else {
                    $user = User::where('id', $id)->update([
                        'nama'         => $request->namaEdit,
                        'tgl_lhr'      => $request->tgl_lhrEdit,
                        'tmp_lhr'      => $request->tmp_lhrEdit,
                        'pendidikan'   => $request->pendidikanEdit,
                        'alamat'       => $request->alamatEdit,
                        'updated_at'   => date('Y-m-d H:i:s')
                    ]);
                }
            });

                $json = [
                    'msg' => 'Member berhasil diubah',
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
                  DB::table('users')->where('id', $id)->delete();
              });

                $json = [
                    'msg' => 'Member berhasil dihapus',
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
