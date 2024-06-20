<?php

namespace App\Http\Controllers;

use App\Models\PerguruanTinggi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerguruanTinggiController extends Controller
{
    public function showKelolaPage(){
        $perguruanTinggi = PerguruanTinggi::all();
        return view('superAdminPage.kelola-perguruan-tinggi',[
            'perguruanTinggi' => $perguruanTinggi,
        ]);
    }

    public function tambahPerguruan(Request $request){
        $validatedData = $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'kode_pt' => 'required|unique:perguruan_tinggi,kode_pt',
            'nama_pt' => 'required',
            'alamat_pt' => 'required',
            'kode_pos_pt' => 'required|numeric',
        ],[
            'username.required' => 'username harus diisi',
            'username.unique' => 'username telah digunakan',
            'password.required' => 'password harus diisi',
            'password.min' => 'password minimal 8 karakter',
            'kode_pt.required' => 'kode perguruan tinggi harus diisi',
            'kode_pt.unique' => 'kode telah digunakan',
            'nama_pt.required' => 'nama perguruan tinggi harus diisi',
            'alamat_pt.required' => 'alamat perguruan tinggi harus diisi',
            'kode_pos_pt.required' => 'kode pos harus diisi',
            'kode_pos_pt.numeric' => 'kode pos harus angka',
        ]);

        $akun = new User();
        $akun->username = $request->username;
        $akun->password = Hash::make($request->password);
        $akun->role = 'perguruan tinggi';
        $akun->save();

        $perguruanTinggi = new PerguruanTinggi();
        $perguruanTinggi->kode_pt = $request->kode_pt;
        $perguruanTinggi->id_user = $akun->id_user;
        $perguruanTinggi->nama_pt = $request->nama_pt;
        $perguruanTinggi->alamat_pt = $request->alamat_pt;
        $perguruanTinggi->kode_pos_pt = $request->kode_pos_pt;

        if ($perguruanTinggi->save()) {
            return redirect()->back()->with([
                'notifikasi' => 'Berhasil membuat akun!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Gagal membuat akun',
                'type' => 'error'
            ]);
        }
    }

    public function editPerguruan(Request $request,$id_user){
        $validatedData = $request->validate([
            'username' => 'required|unique:users,username,' . $request->old_username . ',username',
            'password' => 'required|min:8',
            'kode_pt' => 'required|unique:perguruan_tinggi,kode_pt,' . $request->old_kode_pt . ',kode_pt',
            'nama_pt' => 'required',
            'alamat_pt' => 'required',
            'kode_pos_pt' => 'required|numeric',
        ],[
            'username.required' => 'username harus diisi',
            'username.unique' => 'username telah digunakan',
            'password.required' => 'password harus diisi',
            'password.min' => 'password minimal 8 karakter',
            'kode_pt.required' => 'kode perguruan tinggi harus diisi',
            'kode_pt.unique' => 'kode telah digunakan',
            'nama_pt.required' => 'nama perguruan tinggi harus diisi',
            'alamat_pt.required' => 'alamat perguruan tinggi harus diisi',
            'kode_pos_pt.required' => 'kode pos harus diisi',
            'kode_pos_pt.numeric' => 'kode pos harus angka',
        ]);

        $akun = user::where('id_user',$id_user)->firstOrFail();
        $akun->username = $request->username;
        $akun->password = Hash::make($request->password);
        $akun->save();

        $perguruanTinggi = PerguruanTinggi::where('id_user',$id_user)->firstOrFail();
        $perguruanTinggi->kode_pt = $request->kode_pt;
        $perguruanTinggi->id_user = $akun->id_user;
        $perguruanTinggi->nama_pt = $request->nama_pt;
        $perguruanTinggi->alamat_pt = $request->alamat_pt;
        $perguruanTinggi->kode_pos_pt = $request->kode_pos_pt;

        if ($perguruanTinggi->save()) {
            return redirect()->back()->with([
                'notifikasi' => 'Berhasil mengubah akun!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Gagal mengubah akun',
                'type' => 'error'
            ]);
        }
    }

    public function hapusPerguruan($id_user){
        $akun = user::where('id_user',$id_user);
        if ($akun->count() < 1) {
            return redirect()->back()->with([
            'notifikasi' => 'Data tidak ditemukan !',
            'type' => 'error'
            ]);
        }
        if ( $akun->first()->delete()) {
            return redirect()->back()->with([
            'notifikasi' => 'Akun Berhasil dihapus !',
            'type' => 'success'
            ]);
        }else{
            return redirect()->back()->with([
            'notifikasi' => 'Akun gagal dihapus !',
            'type' => 'error'
            ]);
        }
    }

    public function showProfilePage(){
        $kodePt = Auth::user()->perguruanTinggi->kode_pt;

        $profile = PerguruanTinggi::where('kode_pt', $kodePt)->firstOrFail();
        return view('perguruanTinggiPage.profile-perguruan-tinggi',[
            'dataProfile' => $profile,
        ]);
    }

    public function updateProfile(Request $request, $id_user) {
        $validatedData = $request->validate([
            'kode_pt' => 'required|unique:perguruan_tinggi,kode_pt,' . $request->old_kode_pt . ',kode_pt',
            'nama_pt' => 'required',
            'alamat_pt' => 'required',
            'kode_pos_pt' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'kode_pt.required' => 'Kode perguruan tinggi harus diisi.',
            'kode_pt.unique' => 'Kode perguruan tinggi telah digunakan.',
            'nama_pt.required' => 'Nama perguruan tinggi harus diisi.',
            'alamat_pt.required' => 'Alamat perguruan tinggi harus diisi.',
            'kode_pos_pt.required' => 'Kode pos harus diisi.',
            'kode_pos_pt.numeric' => 'Kode pos harus angka.',
            'foto.image' => 'Foto harus berupa file gambar.',
            'foto.mimes' => 'Foto harus memiliki format jpeg, png,atau jpg.',
            'foto.max' => 'Ukuran foto maksimal 2MB.'
        ]);

        $perguruanTinggi = PerguruanTinggi::where('id_user', $id_user)->firstOrFail();

        $perguruanTinggi->kode_pt = $request->kode_pt;
        $perguruanTinggi->nama_pt = $request->nama_pt;
        $perguruanTinggi->alamat_pt = $request->alamat_pt;
        $perguruanTinggi->kode_pos_pt = $request->kode_pos_pt;

        if ($request->hasFile('foto')) {
            $old_foto = $perguruanTinggi->foto;
            if (!empty($old_foto) && is_file('storage/'.$old_foto)) {
                unlink('storage/'.$old_foto);
            }

            $foto = $request->file('foto')->store('public/foto');
            $foto = basename($foto);
            $perguruanTinggi->foto = $foto ? 'foto/' . $foto : null;
        }else{
            $foto = $perguruanTinggi->foto;
        }

        if ($perguruanTinggi->save()) {
            return redirect()->back()->with([
                'notifikasi' => 'Berhasil mengubah profile!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Gagal mengubah profile',
                'type' => 'error'
            ]);
        }
    }

}
