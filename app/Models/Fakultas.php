<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    protected $table = 'fakultas';
    protected $primaryKey = 'id_fakultas';
    protected $fillable = [
        'fakultas',
        'kode_pt',
    ];

    public function mahasiswa(){
        return $this->hasMany(Mahasiswa::class,'id_fakultas');
    }

    public function perguruanTinggi(){
        return $this->belongsTo(PerguruanTinggi::class,'kode_pt');
    }
}
