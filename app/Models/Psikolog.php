<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;

class Psikolog extends Model implements CanResetPasswordContract
{
    use HasFactory, Notifiable, CanResetPassword;

    protected $table = 'psikolog';
    protected $primaryKey = 'no_str';
    protected $fillable = [
        'no_str',
        'id_user',
        'kode_pt',
        'nama_psikolog',
        'email',
        'alumni',
        'status',
        'no_telp',
        'foto',
    ];

    public function janjiTemu(){
        return $this->hasMany(JanjiTemu::class,'no_str');
    }

    public function akunPsikolog(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function perguruanTinggi(){
        return $this->belongsTo(PerguruanTinggi::class,'kode_pt');
    }

    public function laporanKonsultasi(){
        return $this->hasMany(LaporanKonsultasi::class,'no_str');
    }
}
