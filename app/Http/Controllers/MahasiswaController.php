<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function showKelolaPage(){
        $kodePt = Auth::user()->perguruanTinggi->kode_pt;

        $mahasiswa = Mahasiswa::where('kode_pt', $kodePt)->latest()->get();
        $fakultas = Fakultas::where('kode_pt', $kodePt)->get();
        return view('perguruanTinggiPage.kelola-mahasiswa',[
            'dataMahasiswa' => $mahasiswa,
            'dataFakultas' => $fakultas,
        ]);
    }

    public function tambahMahasiswa(Request $request){
        $validatedData = $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'nim' => 'required|numeric|unique:mahasiswa,nim',
            'nama_mahasiswa' => 'required',
            'alamat' => 'required',
            'email' => 'required|unique:mahasiswa,email|email:dns',
            'jenis_kelamin' => 'required',
            'fakultas' => 'required',
        ], [
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username telah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'nim.required' => 'NIM harus diisi.',
            'nim.numeric' => 'NIM harus berupa angka.',
            'nim.unique' => 'NIM telah digunakan.',
            'nama_mahasiswa.required' => 'Nama mahasiswa harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email telah digunakan.',
            'email.email' => 'Format email tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi.',
            'fakultas.required' => 'Fakultas harus diisi.',
        ]);

        $akun = new User();
        $akun->username = $request->username;
        $akun->password = Hash::make($request->password);
        $akun->role = 'mahasiswa';
        $akun->save();

        $kodePt = Auth::user()->perguruanTinggi->kode_pt;

        $mahasiswa = new Mahasiswa();
        $mahasiswa ->nim = $request -> nim;
        $mahasiswa ->id_user =$akun -> id_user;
        $mahasiswa ->nama_mahasiswa = $request->nama_mahasiswa ;
        $mahasiswa ->alamat = $request -> alamat;
        $mahasiswa ->email = $request -> email;
        $mahasiswa ->jenis_kelamin =$request-> jenis_kelamin;
        $mahasiswa ->kode_pt = $kodePt;
        $mahasiswa ->id_fakultas = $request->fakultas;

        if ($mahasiswa->save()) {
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

    public function editMahasiswa(Request $request,$id_user){
        $validateData = $request->validate([
            'username' => 'required|unique:users,username,' . $request->old_username . ',username',
            'nim' => 'required|numeric|unique:mahasiswa,nim,'. $request->old_nim . ',nim',
            'nama_mahasiswa'=> 'required',
            'alamat' => 'required',
            'email' => 'required|unique:mahasiswa,email,'. $request->old_email . ',email|email:dns',
            'jenis_kelamin' => 'required',
            'fakultas' => 'required',
        ],[
            'username.required' => 'username harus diisi',
            'username.unique' => 'username telah digunakan',
            'nim.required' => 'nim harus diisi',
            'nim.unique' => 'nim telah digunakan.',
            'nama_mahasiswa.required' => 'nama mahasiswa harus diisi',
            'email.required' => 'email harus diisi',
            'email.unique' => 'email telah digunakan',
            'email.email' => 'Format email tidak valid.',
            'jenis_kelamin.required' => 'jenis kelamin harus diisi',
            'fakultas.required' => 'fakultas harus diisi',
        ]);

        $akun = user::where('id_user',$id_user)->firstOrFail();
        $akun->username = $request->username;
        $akun->save();

        $kodePt = Auth::user()->perguruanTinggi->kode_pt;

        $mahasiswa = Mahasiswa::where('id_user',$id_user)->firstOrFail();
        $mahasiswa ->nim = $request -> nim;
        $mahasiswa ->nama_mahasiswa = $request -> nama_mahasiswa ;
        $mahasiswa ->alamat = $request -> alamat;
        $mahasiswa ->email = $request -> email;
        $mahasiswa ->jenis_kelamin =$request-> jenis_kelamin;
        $mahasiswa ->kode_pt = $kodePt;
        $mahasiswa ->id_fakultas = $request->fakultas;

        if($mahasiswa->save()){
            return redirect()->back()->with([
                'notifikasi' => 'Berhasil mengubah mahasiswa',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Gagal mengubah mahasiswa',
                'type' => 'error'
            ]);
        }
    }

    public function hapusMahasiswa($id_user){
        $mahasiswa = user::where('id_user',$id_user);

        if ($mahasiswa->count() < 1) {
            return redirect()->back()->with([
                'notifikasi' =>'Data tidak ditemukan!',
                'type'=>'error'
            ]);
        }
        if ($mahasiswa->first()->delete()) {
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

    public function showProfilePage(){
        $akun = Auth::user()->mahasiswa;

        $fakultas = Fakultas::where('kode_pt', $akun->kode_pt)->get();
        $profile = Mahasiswa::where('nim', $akun->nim)->firstOrFail();
        return view('mahasiswaPage.profile-mahasiswa',[
            'dataProfile' => $profile,
            'dataFakultas' => $fakultas,
        ]);
    }

    public function updateProfile(Request $request, $id_user) {
        $validateData = $request->validate([
            'nama_mahasiswa'=> 'required',
            'alamat' => 'required',
            'email' => 'required|unique:mahasiswa,email,'. $request->old_email . ',email|email:dns',
            'jenis_kelamin' => 'required',
            'fakultas' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'nama_mahasiswa.required' => 'nama_mahasiswa harus diisi',
            'email.required' => 'email harus diisi',
            'email.unique' => 'email telah digunakan',
            'email.email' => 'Format email tidak valid.',
            'jenis_kelamin.required' => 'jenis kelamin harus diisi',
            'fakultas.required' => 'fakultas harus diisi',
            'foto.image' => 'Foto harus berupa file gambar.',
            'foto.mimes' => 'Foto harus memiliki format jpeg, png,atau jpg.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $mahasiswa = Mahasiswa::where('id_user', $id_user)->firstOrFail();

        $mahasiswa->nama_mahasiswa = $request->nama_mahasiswa;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->email = $request->email;
        $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
        $mahasiswa->id_fakultas = $request->fakultas;

        if ($request->hasFile('foto')) {
            $old_foto = $mahasiswa->foto;
            if (!empty($old_foto) && is_file('storage/'.$old_foto)) {
                unlink('storage/'.$old_foto);
            }

            $foto = $request->file('foto')->store('public/foto');
            $foto = basename($foto);
            $mahasiswa->foto = $foto ? 'foto/' . $foto : null;
        }else{
            $foto = $mahasiswa->foto;
        }

        if ($mahasiswa->save()) {
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
