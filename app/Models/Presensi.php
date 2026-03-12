<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama_lengkap', 
        'pangkat_nrp', 
        'jabatan_struktural', 
        'jabatan_panitia', 
        'satker', 
        'pelaksanaan', 
        'tanda_tangan'
    ];
}