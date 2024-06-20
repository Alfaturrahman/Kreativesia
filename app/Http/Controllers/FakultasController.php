<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FakultasController extends Controller
{
    public function showKelolaPage(){
        $kodePt = Auth::user()->perguruanTinggi->kode_pt;
        $fakultas= Fakultas::where('kode_pt', $kodePt)->get();

        return view('perguruanTinggiPage.kelola-fakultas',[
            'dataFakultas' => $fakultas,
        ]);
    }

    public function tambahFakultas(Request $request){
        $validateData = $request->validate([
            'fakultas' => 'required',
        ],[
            'fakultas.required' => 'Fakultas harus diisi',
        ]);

        $kodePt = Auth::user()->perguruanTinggi->kode_pt;

        $fakultas = new Fakultas();
        $fakultas -> fakultas = $request->fakultas;
        $fakultas -> kode_pt = $kodePt;

        if($fakultas->save()){
            return redirect()->back()->with([
                'notifikasi' => 'Berhasil menambahkan fakultas',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Gagal menambahakan fakultas',
                'type' => 'error'
            ]);
        }
    }

    public function editFakultas(Request $request,$id_fakultas){
        $validateData = $request->validate([
            'fakultas' => 'required',
        ],[
            'fakultas.required' => 'Fakultas harus diisi',
        ]);

        $kodePt = Auth::user()->perguruanTinggi->kode_pt;

        $fakultas = Fakultas::where('id_fakultas',$id_fakultas)->firstOrFail();
        $fakultas -> fakultas = $request->fakultas;
        $fakultas -> kode_pt = $kodePt;

        if($fakultas->save()){
            return redirect()->back()->with([
                'notifikasi' => 'Berhasil mengedit fakultas',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Gagal mengedit fakultas',
                'type' => 'error'
            ]);
        }
    }

    public function hapusFakultas($id_fakultas){
        $fakultas = Fakultas::where('id_fakultas',$id_fakultas);
        if ($fakultas->count() < 1) {
            return redirect()->back()->with([
                'notifikasi' =>'Data tidak ditemukan!',
                'type'=>'error'
            ]);
        }
        if ($fakultas->first()->delete()) {
            return redirect()->back()->with([
                'notifikasi'=>"Berhasil menghapus fakultas!",
                "type"=>"success"
            ]);
        }else{
            return redirect()->back()->with([
                'notifikasi'=>"Gagal menghapus fakultas!",
                "type"=>"error",
            ]);
        }
    }
}
