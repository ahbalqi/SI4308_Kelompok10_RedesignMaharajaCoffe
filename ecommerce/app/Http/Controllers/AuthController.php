<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Session;

class AuthController extends Controller
{
    public function login(){
        return view('auth/login');
    }

    public function login_admin(){
        return view('auth/admin');
    }

    public function register(){
        return view('auth/register');
    }

    public function do_register(Request $request){
        $request->validate([
            'nama'      => 'required',
            'email'     => 'required',
            'no_hp'     => 'required',
            'password'  => 'required'
        ]);

        $user = new Customer();
        $input = $request->except(['_token']);

        if($input['password'] != $input['confirm_password']){
            return redirect('/register')->with('alert', show_alert('Password yang kamu ketikkan tidak sama', 'danger'));    
        }
        
        if($user->data('email', $input['email'])->count() > 0){
            return redirect('/register')->with('alert', show_alert('Email sudah terdaftar, silahkan gunakan yang lain', 'danger'));    
        }

        $data = [
            'nama' => $input['nama'],
            'email' => $input['email'],
            'password' => $input['password'],
            'no_hp' => $input['no_hp']
        ];
        if(!$user->create($data)){
            return redirect('/register')->with('alert', show_alert('Terjadi kesalahan, coba lagi nanti', 'danger'));  
        }

        return redirect('/login')->with('alert', show_alert('Berhasil melakukan pendaftaran, silahkan login', 'success'));    
    }

    public function do_login(Request $request){
        $request->validate([
            'email'      => 'required',
            'password'     => 'required'
        ]);

        $user = new Customer();
        $input = $request->except(['_token']);
        
        $find = [
            'email' => $input['email'],
            'password' => $input['password']
        ];

        $credential = $user->data($find);
        if($credential->count() == 0){
            return redirect('/login')->with('alert', show_alert('Email tidak ditemukan, pastikan memasukkan data akun yang benar', 'danger'));    
        }

        $userdata = $credential->first();
        $request->session()->put('login', true);
        $request->session()->put('role', $userdata->role);
        $request->session()->put('userdata', $userdata);

        $redirectTo = $userdata->role == 'admin' ? '/dashboard' : '/';
        return redirect($redirectTo)->with('alert', show_alert('Login berhasil', 'success'));    
    }

    public function do_logout(){
        Session::forget('login');
        Session::forget('role');
        Session::forget('userdata');
        return redirect('/login')->with('alert', show_alert('Logout berhasil', 'success')); 
    }
}
