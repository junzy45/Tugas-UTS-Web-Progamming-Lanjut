<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinasiWisata extends Model
{
    protected $fillable = [
        'nama',
        'lokasi',
        'deskripsi',
        'harga_tiket',
        'gambar'
    ];
}

