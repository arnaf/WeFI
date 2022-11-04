<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email'     => 'required|email',
            'password'  => 'required',

        ];

        $messages = [
            'email.required'        => 'Username wajib diisi',
            'email.email'           => 'Email wajib berupa email',
            'password.required'     => 'Password wajib diisi',


        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];

        if($request->has('remember')) {
            $remember = true;
        } else {
            $remember = false;
        }

        Auth::attempt($data, $remember);

        if(Auth::check()) {
            return redirect()->to('/dashboard');
        }
        return redirect()->back()->withErrors(['error' => 'Email / Password salah'])->withInput($request->all);

    }

    public function logout()
    {
        Auth::logout();

        return redirect()->to('/');
    }


    public function dashboard() {

        $jml_user = User::where('id', '>', 2)
        ->count();

        $total_tr = Tagihan::where('status', 'Terbayar')
        ->count();


        $data = [
            'totalusers' => $jml_user,
            'totaltrs'   => $total_tr
        ];

        return view('components.menus.dashboard', $data);
    }
}
