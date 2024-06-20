<?php

namespace App\Http\Controllers;

use App\Models\JanjiTemu;
use Illuminate\Http\Request;

class JanjiTemuController extends Controller
{
    public function ajukanJanjiProcess(Request $request){
        $validatedData = $request->validate([
            'nim' => 'required|numeric',
            'no_str' => 'required|numeric',
            'keluhan_umum' => 'required',
            'detail_masalah' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'jenis_konsultasi' => 'required',
        ], [
            'nim.required' => 'NIM harus diisi.',
            'nim.numeric' => 'NIM harus berupa angka.',
            'no_str.required' => 'Nomor STR harus diisi.',
            'no_str.numeric' => 'Nomor STR harus berupa angka.',
            'keluhan_umum.required' => 'Keluhan umum harus diisi.',
            'detail_masalah.required' => 'Detail masalah harus diisi.',
            'tanggal.required' => 'Tanggal harus diisi.',
            'jam.required' => 'Jam harus diisi.',
            'jenis_konsultasi.required' => 'Jenis konsultasi harus diisi.',
        ]);

        $janjiTemu = new JanjiTemu();
        $janjiTemu->nim = $request->nim;
        $janjiTemu->no_str = $request->no_str;
        $janjiTemu->keluhan_umum = $request->keluhan_umum;
        $janjiTemu->detail_masalah = $request->detail_masalah;
        $janjiTemu->tanggal = $request->tanggal;
        $janjiTemu->jam = $request->jam;
        $janjiTemu->jenis_konsultasi = $request->jenis_konsultasi;

        if ($janjiTemu->save()) {
            return redirect()->route('riwayatKonsulPage')->with([
                'notifikasi' => 'Berhasil mengajukan janji!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Gagal mengajukan janji!',
                'type' => 'error'
            ]);
        }
    }

    public function terimaJanjiTemu(Request $request,$id_janji_temu){
        $validatedData = $request->validate([
            'keterangan' => 'nullable',
        ]);

        $janjiTemu = JanjiTemu::where('id_janji_temu',$id_janji_temu)->firstOrFail();

        if($request->has('keterangan')){
            $janjiTemu->keterangan = $request->keterangan;
        }else{
            $janjiTemu->keterangan = null;
        }

        $janjiTemu->status = 'diterima';

        if ($janjiTemu->save()) {
            return redirect()->back()->with([
                'notifikasi' => 'Berhasil menerima pasien!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Gagal menerima pasien!',
                'type' => 'error'
            ]);
        }
    }

    public function rescheduleJanjiTemu(Request $request,$id_janji_temu){
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required',
            'keterangan' => 'required',
        ], [
            'tanggal.required' => 'Tanggal perubahan janji temu harus diisi.',
            'tanggal.date' => 'Tanggal perubahan janji temu harus dalam format tanggal yang valid.',
            'jam.required' => 'Jam perubahan janji temu harus diisi.',
            'keterangan.required' => 'Keterangan perubahan janji temu harus diisi.',
        ]);

        $janjiTemu = JanjiTemu::where('id_janji_temu',$id_janji_temu)->firstOrFail();

        $janjiTemu->tanggal = $request->tanggal;
        $janjiTemu->jam = $request->jam;
        $janjiTemu->keterangan = $request->keterangan;
        $janjiTemu->status = 'diterima,jadwal telah diatur ulang';

        if ($janjiTemu->save()) {
            return redirect()->back()->with([
                'notifikasi' => 'Berhasil mengubah jadwal!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Gagal mengubah jadwal!',
                'type' => 'error'
            ]);
        }
    }

    public function updateStatusSelesai($id_janji_temu){
        $janjiTemu = JanjiTemu::where('id_janji_temu',$id_janji_temu)->firstOrFail();

        $janjiTemu->status = 'selesai';

        if ($janjiTemu->save()) {
            return redirect()->back()->with([
                'notifikasi' => 'Berhasil mengubah status!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Gagal mengubah status!',
                'type' => 'error'
            ]);
        }
    }
}
