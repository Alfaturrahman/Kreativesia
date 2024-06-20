<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;

class Mahasiswa extends Model implements CanResetPasswordContract
{
    use HasFactory, Notifiable, CanResetPassword;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    protected $fillable = [
        'nim',
        'id_user',
        'kode_pt',
        'id_fakultas',
        'nama_mahasiswa',
        'alamat',
        'email',
        'jenis_kelamin',
        'foto'
    ];

    public function janjiTemu(){
        return $this->hasMany(JanjiTemu::class,'nim');
    }

    public function akunMahasiswa(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function fakultas(){
        return $this->belongsTo(Fakultas::class,'id_fakultas');
    }

    public function perguruanTinggi(){
        return $this->belongsTo(PerguruanTinggi::class,'kode_pt');
    }

    public function hasilKonsultasi(){
        return $this->hasMany(LaporanKonsultasi::class,'nim');
    }
}
