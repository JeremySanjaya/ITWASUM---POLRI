<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterOption extends Model
{
    protected $fillable = [
        'kategori', 
        'nama_opsi'
    ];
}