<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginPage()
    {
        return view('login');
    }

    public function loginProcess(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)){
            $user = Auth::user();
            $request->session()->regenerate();
            if ($user->role === 'mahasiswa'){
                return redirect()->route('layananPage')->with([
                    'notifikasi' => 'Selamat Datang ' . $user->mahasiswa->nama_mahasiswa,
                    'type' => 'success'
                ]);
            }elseif($user->role === 'psikolog'){
                $user->psikolog->update(['status' => 'online']);

                return redirect()->route('pasienPage')->with([
                    'notifikasi' => 'Selamat Datang ' . $user->psikolog->nama_psikolog,
                    'type' => 'success'
                ]);
            }elseif($user->role === 'perguruan tinggi'){
                return redirect()->route('hasilLaporanPsikologPage')->with([
                    'notifikasi' => 'Selamat Datang ' . $user->perguruanTinggi->nama_pt,
                    'type' => 'success'
                ]);
            }elseif($user->role === 'superadmin'){
                return redirect()->route('kelolaPerguruanPage')->with([
                    'notifikasi' => 'Selamat Datang ' . $user->role,
                    'type' => 'success'
                ]);
            }
        }
        return redirect()->back()->withInput()->with([
            'notifikasi' => 'Login Failed !',
            'type' => 'error'
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if($user->role == 'psikolog'){
            $user->psikolog->update(['status' => 'offline']);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginPage')->with([
            'notifikasi' => 'Anda berhasil logout !',
            'type' => 'success'
        ]);
    }
}

