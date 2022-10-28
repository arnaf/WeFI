<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request) {


        $rules = [
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8',
            'nama'      => 'required',
            'tgl_lhr'   => 'required',
            'tmp_lhr'   => 'required',
            'alamat'    => 'required',
            'pendidikan'=> 'required',
        ];

        $message = [
            'email.required'     => 'Mohon isikan email anda',
            'email.email'       => 'Mohon isikan email valid',
            'email.unique'      => 'Email sudah terdaftar',
            'password.required' => 'Mohon isikan password anda',
            'password.min'      => 'Password wajib mengandung minimal 8 karakter',
            'nama.required'         => 'Nama wajib diisi',
            'tgl_lhr.required'      => 'Tanggal lahir wajib diisi',
            'tmp_lhr.required'      => 'Tempat lahir wajib diisi',
            'alamat.required'       => 'Alamat wajib diisi',
            'pendidikan.required'   => 'Pendidikan wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        try {
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'email'         => $request->email,
                    'password'      => Hash::make($request->password),
                    'nama'          => $request->nama,
                    'tgl_lhr'       => $request->tgl_lhr,
                    'tmp_lhr'       => $request->tmp_lhr,
                    'alamat'        => $request->alamat,
                    'pendidikan'    => $request->pendidikan,
                    'created_at'    => date('Y-m-d H:i:s')
                ]);
                $user->syncRoles('member');

            });

            return redirect()->to('/');
        } catch(Exception $e) {
            return redirect()->to('/register');
        }
    }
}
