<?php

namespace App\Http\Controllers;

use App\Models\Psikolog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PsikologController extends Controller
{
    public function showKelolaPage(){
        $kode_pt = Auth::user()->perguruanTinggi->kode_pt;

        $psikolog = Psikolog::where('kode_pt', $kode_pt)->latest()->get();
        return view('perguruanTinggiPage.kelola-psikolog',[
            'dataPsikolog' => $psikolog,
        ]);
    }

    public function tambahPsikolog(request $request){
        $validateData = $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'no_str' => 'required|numeric|unique:psikolog,no_str',
            'nama_psikolog' => 'required',
            'alumni' => 'required',
            'email' => 'required|unique:psikolog,email|email:dns',
            'no_telp' => 'required|numeric',
        ], [
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username telah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'no_str.required' => 'Nomor STR harus diisi.',
            'no_str.numeric' => 'Nomor STR harus berupa angka.',
            'no_str.unique' => 'Nomor STR telah digunakan.',
            'nama_psikolog.required' => 'Nama psikolog harus diisi.',
            'alumni.required' => 'Alumni harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email telah digunakan.',
            'email.email' => 'Format email tidak valid.',
            'no_telp.required' => 'Nomor telepon harus diisi.',
            'no_telp.numeric' => 'Nomor telepon harus berupa angka.',
        ]);

        $akun = new User();
        $akun->username = $request->username;
        $akun->password = Hash::make($request->password);
        $akun->role = 'psikolog';
        $akun->save();

        $kode_pt = Auth::user()->perguruanTinggi->kode_pt;

        $psikolog = new Psikolog();
        $psikolog ->no_str = $request->no_str;
        $psikolog ->id_user = $akun->id_user;
        $psikolog ->nama_psikolog = $request->nama_psikolog ;
        $psikolog ->alumni = $request->alumni;
        $psikolog ->email = $request->email;
        $psikolog ->no_telp = $request->no_telp;
        $psikolog ->kode_pt = $kode_pt;

        if ($psikolog->save()) {
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
    public function editPsikolog(Request $request,$id_user){
        $validateData = $request->validate([
            'username' => 'required|unique:users,username,' . $request->old_username . ',username',
            'no_str' => 'required|numeric|unique:psikolog,no_str,' . $request->old_no_str . ',no_str',
            'nama_psikolog' => 'required',
            'alumni' => 'required',
            'email' => 'required|unique:psikolog,email,' . $request->old_email . ',email|email:dns',
            'no_telp' => 'required|numeric',
        ], [
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username telah digunakan.',
            'no_str.required' => 'Nomor STR harus diisi.',
            'no_str.numeric' => 'Nomor STR harus berupa angka.',
            'no_str.unique' => 'Nomor STR telah digunakan.',
            'nama_psikolog.required' => 'Nama psikolog harus diisi.',
            'alumni.required' => 'Alumni harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email telah digunakan.',
            'email.email' => 'Email tidak valid.',
            'no_telp.required' => 'Nomor telepon harus diisi.',
            'no_telp.numeric' => 'Nomor telepon harus berupa angka.',
        ]);

        $akun = user::where('id_user',$id_user)->firstOrFail();
        $akun->username = $request->username;
        $akun->save();

        $kode_pt = Auth::user()->perguruanTinggi->kode_pt;

        $psikolog = Psikolog::where('id_user',$id_user)->firstOrFail();
        $psikolog ->no_str = $request -> no_str;
        $psikolog ->nama_psikolog = $request -> nama_psikolog ;
        $psikolog ->alumni = $request -> alumni;
        $psikolog ->email = $request -> email;
        $psikolog ->no_telp =$request-> no_telp;
        $psikolog ->kode_pt = $kode_pt;

        if($psikolog->save()){
            return redirect()->back()->with([
                'notifikasi' => 'Berhasil mengubah psikolog',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Gagal mengubah psikolog',
                'type' => 'error'
            ]);
        }
    }

    public function hapusPsikolog($id_user){
        $psikolog = user::where('id_user',$id_user);
        if ($psikolog->count() < 1) {
            return redirect()->back()->with([
                'notifikasi' =>'Data tidak ditemukan!',
                'type'=>'error'
            ]);
        }
        if ($psikolog->first()->delete()) {
            return redirect()->back()->with([
                'notifikasi'=>"Berhasil menghapus data!",
                "type"=>"success"
            ]);
        }else{
            return redirect()->back()->with([
                'notifikasi'=>"Gagal menghapus data!",
                "type"=>"error",
            ]);
        }
    }

    public function updateStatus($jenis_status){
        $noStr = Auth::user()->psikolog->no_str;

        $psikolog = Psikolog::where('no_str', $noStr)->firstOrFail();

        $psikolog->status = $jenis_status;

        if ($psikolog->save()) {
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

    public function showProfilePage(){
        $no_str = Auth::user()->psikolog->no_str;

        $profile = Psikolog::where('no_str', $no_str)->firstOrFail();
        return view('psikologPage.profile-psikolog',[
            'dataProfile' => $profile,
        ]);
    }

    public function updateProfile(Request $request, $id_user) {
        $validateData = $request->validate([
            'no_str' => 'required|numeric|unique:psikolog,no_str,' . $request->old_no_str . ',no_str',
            'nama_psikolog' => 'required',
            'alumni' => 'required',
            'email' => 'required|unique:psikolog,email,' . $request->old_email . ',email|email:dns',
            'no_telp' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'no_str.required' => 'Nomor STR harus diisi.',
            'no_str.numeric' => 'Nomor STR harus berupa angka.',
            'no_str.unique' => 'Nomor STR telah digunakan.',
            'nama_psikolog.required' => 'Nama psikolog harus diisi.',
            'alumni.required' => 'Alumni harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email telah digunakan.',
            'email.email' => 'Email tidak valid.',
            'no_telp.required' => 'Nomor telepon harus diisi.',
            'no_telp.numeric' => 'Nomor telepon harus berupa angka.',
            'foto.image' => 'Foto harus berupa file gambar.',
            'foto.mimes' => 'Foto harus memiliki format jpeg, png,atau jpg.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $Psikolog = Psikolog::where('id_user', $id_user)->firstOrFail();

        $Psikolog->no_str = $request->no_str;
        $Psikolog->nama_psikolog = $request->nama_psikolog;
        $Psikolog->alumni = $request->alumni;
        $Psikolog->email = $request->email;
        $Psikolog->no_telp = $request->no_telp;

        if ($request->hasFile('foto')) {
            $old_foto = $Psikolog->foto;
            if (!empty($old_foto) && is_file('storage/'.$old_foto)) {
                unlink('storage/'.$old_foto);
            }

            $foto = $request->file('foto')->store('public/foto');
            $foto = basename($foto);
            $Psikolog->foto = $foto ? 'foto/' . $foto : null;
        }else{
            $foto = $Psikolog->foto;
        }

        if ($Psikolog->save()) {
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
