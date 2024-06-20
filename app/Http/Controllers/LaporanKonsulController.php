<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\JanjiTemu;
use App\Models\LaporanKonsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanKonsulController extends Controller
{
    public function showLaporanPsikologPage(){
        $noStr = Auth::user()->psikolog->no_str;

        $laporan = LaporanKonsultasi::where('no_str', $noStr)->latest()->get();
        $idJanjitemu = JanjiTemu::where('no_str', $noStr)->where('status','selesai')->get();
        return view('psikologPage.laporan-psikolog',[
            'laporanKonsul' => $laporan,
            'idJanjiTemu' => $idJanjitemu,
        ]);
    }

    public function tambahLaporan(Request $request){
        $validatedData = $request->validate([
            'id_janji_temu' => 'required',
            'laporan_perguruan_tinggi' => 'required',
            'catatan_mahasiswa' => 'required',
            'tingkat_permasalahan' => 'required',
        ],[
            'id_janji_temu.required' => 'ID janji temu harus diisi.',
            'laporan_perguruan_tinggi.required' => 'Laporan perguruan tinggi harus diisi.',
            'catatan_mahasiswa.required' => 'Catatan mahasiswa harus diisi.',
            'tingkat_permasalahan.required' => 'Tingkat permasalahan harus diisi.',
        ]);

        $laporan = new LaporanKonsultasi();

        $laporan->id_janji_temu = $request->id_janji_temu;

        $janjiTemu = JanjiTemu::where('id_janji_temu',$request->id_janji_temu)->firstOrFail();

        $laporan->nim = $janjiTemu->nim;

        $laporan->kode_pt = Auth::user()->psikolog->kode_pt;
        $laporan->no_str = Auth::user()->psikolog->no_str;
        $laporan->laporan_perguruan_tinggi = $request->laporan_perguruan_tinggi;
        $laporan->catatan_mahasiswa = $request->catatan_mahasiswa;
        $laporan->tingkat_permasalahan = $request->tingkat_permasalahan;

        if ($laporan->save()) {
            return redirect()->back()->with([
                'notifikasi' => 'Laporan konsultasi berhasil ditambahkan!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Gagal menambahkan laporan konsultasi',
                'type' => 'error'
            ]);
        }
    }

    public function editLaporan(Request $request,$id_laporan_konsultasi){
        $validatedData = $request->validate([
            'laporan_perguruan_tinggi' => 'required',
            'catatan_mahasiswa' => 'required',
            'tingkat_permasalahan' => 'required',
        ],[
            'laporan_perguruan_tinggi.required' => 'Laporan perguruan tinggi harus diisi.',
            'catatan_mahasiswa.required' => 'Catatan mahasiswa harus diisi.',
            'tingkat_permasalahan.required' => 'Tingkat permasalahan harus diisi.',
        ]);

        $laporan = LaporanKonsultasi::where('id_laporan_konsultasi',$id_laporan_konsultasi)->firstOrFail();

        $laporan->tingkat_permasalahan = $request->tingkat_permasalahan;
        $laporan->catatan_mahasiswa = $request->catatan_mahasiswa;
        $laporan->laporan_perguruan_tinggi = $request->laporan_perguruan_tinggi;

        if ($laporan->save()) {
            return redirect()->back()->with([
                'notifikasi' => 'Laporan konsultasi berhasil diubah!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Gagal mengubah laporan konsultasi',
                'type' => 'error'
            ]);
        }
    }

    public function showHasilLaporanPsikologPage(){
        $kodePt = Auth::user()->perguruanTinggi->kode_pt;

        $hasilLaporan = LaporanKonsultasi::where('kode_pt',$kodePt)->latest()->get();
        return view('PerguruanTinggiPage.hasil-laporan-psikolog',[
            'hasilLaporan' => $hasilLaporan,
        ]);
    }

    public function showStatistik(Request $request) {
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $kode_pt = Auth::user()->perguruanTinggi->kode_pt;

        $data = Fakultas::leftJoin('mahasiswa', function($join) use ($kode_pt) {
            $join->on('fakultas.id_fakultas', '=', 'mahasiswa.id_fakultas')
                ->where('mahasiswa.kode_pt', $kode_pt);
        })
        ->leftJoin('laporan_konsultasi', function($join) use ($tahun, $bulan) {
            $join->on('mahasiswa.nim', '=', 'laporan_konsultasi.nim')
                ->whereYear('laporan_konsultasi.created_at', $tahun)
                ->whereMonth('laporan_konsultasi.created_at', $bulan);
        })
        ->where(function($query) use ($tahun, $bulan) {
            $query->whereYear('laporan_konsultasi.created_at', $tahun)
            ->whereMonth('laporan_konsultasi.created_at', $bulan);
        })
        ->groupBy('fakultas.id_fakultas', 'fakultas.fakultas')
        ->select('fakultas.fakultas',
            DB::raw('SUM(CASE WHEN mahasiswa.jenis_kelamin = "Pria" THEN 1 ELSE 0 END) AS pria'),
            DB::raw('SUM(CASE WHEN mahasiswa.jenis_kelamin = "Wanita" THEN 1 ELSE 0 END) AS wanita'))
        ->get();

        if ($data->isEmpty()) {
            return redirect()->back()->with([
                'notifikasi' => 'Data tidak ditemukan.',
                'type' => 'error'
            ]);
        }

        $labels = $data->pluck('fakultas');
        $dataPria = $data->pluck('pria');
        $dataWanita = $data->pluck('wanita');

        return redirect()->route('hasilLaporanPsikologPage')->with([
            'labels' => $labels,
            'dataPria' => $dataPria,
            'dataWanita' => $dataWanita,
        ]);
    }

    public function showHasilKonsultasiMahasiswaPage(){
        $nim = Auth::user()->mahasiswa->nim;

        $hasilKonsul = LaporanKonsultasi::where('nim', $nim)->latest()->get();
        return view('MahasiswaPage.hasil-konsultasi',[
            'hasilKonsultasi' => $hasilKonsul,
        ]);
    }

}
