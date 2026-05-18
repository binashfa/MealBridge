<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Community;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth');
    }

    public function register(Request $request)
    {
        $user = User::create([

            'username' => $request->username,

            'email' => $request->email,

            'no_telp' => $request->no_telp,

            'password' => Hash::make($request->password),

            'role' => $request->role

        ]);

        if ($request->role == 'supplier') {
            Supplier::create([

                'user_id' => $user->id,

                'nama_toko' => $request->nama_toko,

                'alamat_toko' => $request->alamat_toko

            ]);
        } elseif ($request->role == 'community') {
            Community::create([

                'user_id' => $user->id,

                'nama_komunitas' => $request->nama_komunitas,

                'tujuan_komunitas' => $request->tujuan_komunitas,

                'alamat_komunitas' => $request->alamat_komunitas

            ]);
        }

        return back();
    }

    public function login(Request $request)
    {
        $credentials = $request->only(
            'email',
            'password'
        );

        if (Auth::attempt($credentials)) {
            /*
        |--------------------------------------------------------------------------
        | ROLE REDIRECT
        |--------------------------------------------------------------------------
        */

            if (Auth::user()->role == 'supplier') {
                return redirect('/dashboard-supplier');
            } elseif (Auth::user()->role == 'community') {
                return redirect('/dashboard-community');
            } elseif (Auth::user()->role == 'superadmin') {
                return redirect('/dashboard-admin');
            }
        }

        return back()->with(
            'error',
            'Email atau password salah'
        );
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
