<?php

namespace App\Http\Controllers;

use App\Models\JanjiTemu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function showPasienPage(){
        $noStr = Auth::user()->psikolog->no_str;

        $pasien = JanjiTemu::where('no_str', $noStr)->get();

        return view('psikologPage.pasien', [
            'dataPasien' => $pasien,
            'dataPasienMenunggu' => $pasien->where('status', 'menunggu')->sortByDesc('created_at'),
            'dataPasienDiterima' => $pasien->whereIn('status', ['diterima', 'diterima,jadwal telah diatur ulang'])->sortByDesc('updated_at'),
            'dataPasienSelesai' => $pasien->where('status', 'selesai')->sortByDesc('updated_at'),
        ]);
    }

}
