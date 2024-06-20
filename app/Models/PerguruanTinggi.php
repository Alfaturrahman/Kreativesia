<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerguruanTinggi extends Model
{
    use HasFactory;

    protected $table = 'perguruan_tinggi';
    protected $primaryKey = 'kode_pt';
    protected $fillable = [
        'kode_pt',
        'id_user',
        'nama_pt',
        'alamat_pt',
        'kode_pos_pt',
        'foto',
    ];

    public function akunPerguruanTinggi(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function fakultas(){
        return $this->hasMany(Fakultas::class, 'kode_pt');
    }

    public function mahasiswa(){
        return $this->hasMany(Mahasiswa::class, 'kode_pt');
    }

    public function psikolog(){
        return $this->hasMany(Psikolog::class,'kode_pt');
    }

    public function laporanKonsultasi(){
        return $this->hasMany(LaporanKonsultasi::class,'kode_pt');
    }

    protected $casts = [
        'kode_pt' => 'string',
    ];
}
