<?php

namespace App\Http\Controllers;

use App\Models\Psikolog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayananController extends Controller
{
    public function showLayananPage(){
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role == 'mahasiswa') {
                $kode_pt = $user->mahasiswa->kode_pt;

                $psikolog = Psikolog::where('kode_pt', $kode_pt)
                    ->orderByRaw("CASE
                        WHEN status = 'online' THEN 1
                        WHEN status = 'sibuk' THEN 2
                        WHEN status = 'offline' THEN 3
                        ELSE 4
                    END")
                    ->get();

                return view('mahasiswaPage.layanan', [
                    'dataPsikolog' => $psikolog
                ]);
            }else {
                // Pengguna dengan peran lain, seperti perguruan tinggi, psikolog, atau superadmin
                return redirect()->back()->with([
                    'notifikasi' => 'Anda tidak memiliki akses ke halaman ini',
                    'type' => 'error'
                ]);
            }
        } else {
            return view('mahasiswaPage.layanan');
        }
    }
}
