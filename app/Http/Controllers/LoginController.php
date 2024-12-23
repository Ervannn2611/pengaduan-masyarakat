<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login.
     */
    public function login(Request $request)
{
    $action = $request->input('action');

    // **Login**
    if ($action === 'login') {
        $request->validate([
            "email" => 'required|email',
            "password" => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect sesuai role pengguna
            if ($user->role === 'GUEST') {
                return redirect()->route('reports.dashboard')->with('success', 'Login Berhasil sebagai Guest');
            } elseif ($user->role === 'HEAD_STAFF') {
                return redirect()->route('headstaff.dashboard')->with('success', 'Login Berhasil sebagai Head Staff');
            } elseif ($user->role === 'STAFF') {
                return redirect()->route('staff.dashboard')->with('success', 'Login Berhasil sebagai Staff');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Role tidak dikenali');
            }
        } else {
            return redirect()->back()->with('error', 'Login Gagal, email atau password salah');
        }
    }

    // **Register**
    if ($action === 'register') {
        $request->validate([
            "email" => 'required',
            "password" => 'required',
        ]);

        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'GUEST',
        ]);

        Auth::login($user);

        return redirect()->route('reports.dashboard')->with('success', 'Akun berhasil dibuat dan Anda telah login.');
    }

    return redirect()->back()->with('error', 'Permintaan tidak valid.');

        

        //register + login
        if ($action === 'register') {
            // Validasi input
            $request->validate([
                "email" => 'required|email',
                "password" => 'required',
            ]);

            $user = User::create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
    
            Auth::login($user);

            return redirect()->route('home')->with('success', 'Login Berhasil sebagai Guest');
        }

        return redirect()->back()->with('error', 'Gagal membuat akun');
        
}

    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required',
    //     ]);

    //     User::create([
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'role' => 'GUEST',
    //     ]);

    //     return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
    // }

    /**
     * Proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama
        return redirect('/');
    }
}
