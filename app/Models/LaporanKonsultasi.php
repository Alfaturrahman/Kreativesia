<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKonsultasi extends Model
{
    use HasFactory;

    protected $table = 'laporan_konsultasi';
    protected $primaryKey = 'id_laporan_konsultasi';
    protected $fillable = [
        'nim',
        'kode_pt',
        'no_str',
        'id_janji_temu',
        'laporan_perguruan_tinggi',
        'catatan_mahasiswa',
        'tingkat_permasalahan',
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'nim');
    }

    public function perguruanTinggi(){
        return $this->belongsTo(PerguruanTinggi::class,'kode_pt');
    }

    public function psikolog(){
        return $this->belongsTo(Psikolog::class,'no_str');
    }

    public function janjiTemu(){
        return $this->belongsTo(JanjiTemu::class,'id_janji_temu');
    }
}
