<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
        return redirect('/dashboard');
    }
        return view("pages.auth.login");
    }
    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            
            $user = Auth::user();
            $userStatus = $user->status;

            if ($userStatus == 'submitted') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                return back()->withErrors([
                    'email' => 'Akun anda masih menunggu persetujuan admin'
                ])->onlyInput('email');
            } elseif ($userStatus == 'rejected') {
                return back()->withErrors([
                    'email'=> 'Akun anda telah ditolak admin'
                ])->onlyInput('email');
            }

        if ($user->role_id == 1) {
            return redirect()->intended('/admin/dashboard');
        } else {
            return redirect()->intended('/dashboard');
        }
    }

    return back()->withErrors([
        'email' => 'Terjadi kesalahan! periksa kembali email atau password anda.'
    ])->onlyInput('email');
}

public function registerView()
{
    if (Auth::check()) {
        return redirect('/dashboard');
     }

    return view('pages.auth.register');
}

public function register(Request $request)
{
    if (Auth::check()) {
        return redirect('/dashboard');
    }

    $validated = $request->validate([
            'name'=> ['required','string','max:255'],
            'email'=> ['required', 'email'],
            'password'=> ['required'],
    ]);

    $user = new User();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('password'));
    $user->role_id = 2;
    $user->saveOrFail();

    return redirect('/')->with('success','Berhasil mendaftarkan akun, menunggu persetujuan admin');
}

public function logout(Request $request)
{
    if (!Auth::check()) {
            return redirect('/');
    }

    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/');
}

}
