<?php

namespace App\Http\Controllers;

use App\Models\JanjiTemu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatKonsulController extends Controller
{
    public function showRiwayatKonsulPage(){
        $nim = Auth::user()->mahasiswa->nim;
        $riwayatKonsul = JanjiTemu::where('nim', $nim)->latest()->get();;
        return view('mahasiswaPage.riwayat-konsultasi',[
            'dataRiwayat' => $riwayatKonsul,
        ]);
    }
}
