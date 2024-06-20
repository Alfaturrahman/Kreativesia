<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JanjiTemu extends Model
{
    use HasFactory;

    protected $table = 'janji_temu';
    protected $primaryKey = 'id_janji_temu';
    protected $fillable = [
        'nim',
        'no_str',
        'keluhan_umum',
        'detail_masalah',
        'tanggal',
        'jam',
        'jenis_konsultasi',
        'status',
        'keterangan',
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'nim');
    }

    public function psikolog(){
        return $this->belongsTo(Psikolog::class,'no_str');
    }

    public function laporanKonsultasi(){
        return $this->hasOne(LaporanKonsultasi::class,'id_janji_temu');
    }
}
