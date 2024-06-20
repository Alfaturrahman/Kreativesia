<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\PerguruanTinggi;
use App\Models\Psikolog;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $superAdmin = user::create([
            'username' => 'superadmin',
            'password' => Hash::make('1'),
            'role' => 'superadmin',
        ]);

        $akunPerguruanTinggi = user::create([
            'username' => 'ptn',
            'password' => Hash::make('1'),
            'role' => 'perguruan tinggi',
        ]);

        $perguruanTinggi = PerguruanTinggi::create([
            'kode_pt' => 'PT01',
            'id_user' => $akunPerguruanTinggi->id_user,
            'nama_pt' => 'Politeknik Negeri Batam',
            'alamat_pt' => 'Batam Centre, Jl. Ahmad Yani, Tlk. Tering, Kec. Batam Kota, Kota Batam, Kepulauan Riau',
            'kode_pos_pt'=> '29461',
        ]);

        $fakultas = Fakultas::create([
            'fakultas' => 'Teknik Informatika',
            'kode_pt' => 'PT01',
        ]);

        $akunPsikolog = User::create([
            'username' => 'psikolog',
            'password' => Hash::make('1'),
            'role' => 'psikolog',
        ]);

        $akunPsikolog1 = User::create([
            'username' => 'psikolog1',
            'password' => Hash::make('1'),
            'role' => 'psikolog',
        ]);

        $akunPsikolog2 = User::create([
            'username' => 'psikolog2',
            'password' => Hash::make('1'),
            'role' => 'psikolog',
        ]);

        $psikolog = Psikolog::create([
            'no_str' => '11111',
            'id_user' => $akunPsikolog->id_user,
            'kode_pt' => 'PT01',
            'nama_psikolog' => 'Dr. Ahmad',
            'email' => 'ahmad@gmail.com',
            'alumni' => 'Universitas Gajah Mada',
            'status' => 'online',
            'no_telp' => '0888888',
        ]);

        $psikolog1 = Psikolog::create([
            'no_str' => '1232',
            'id_user' => $akunPsikolog1->id_user,
            'kode_pt' => 'PT01',
            'nama_psikolog' => 'Dr. alfa',
            'email' => 'alfa@gmail.com',
            'alumni' => 'Universitas Gajah Mada',
            'status' => 'sibuk',
            'no_telp' => '0888888',
        ]);

        $psikolog2 = Psikolog::create([
            'no_str' => '4214',
            'id_user' => $akunPsikolog2->id_user,
            'kode_pt' => 'PT01',
            'nama_psikolog' => 'Dr. hadi',
            'email' => 'hadi@gmail.com',
            'alumni' => 'Universitas Gajah Mada',
            'status' => 'offline',
            'no_telp' => '0888888',
        ]);

        $akunMahasiswa = User::create([
            'username' => 'mahasiswa',
            'password' => Hash::make('1'),
            'role' => 'mahasiswa',
        ]);

        $mahasiswa = Mahasiswa::create([
            'nim' => '434220',
            'id_user' => $akunMahasiswa->id_user,
            'kode_pt' => 'PT01',
            'id_fakultas' => $fakultas->id_fakultas,
            'nama_mahasiswa' => 'iqbal',
            'alamat' => 'batam centre',
            'email' => 'iqbal@gmail.com',
            'jenis_kelamin' => 'pria',
        ]);

    }
}
