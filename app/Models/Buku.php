<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    public $incrementing = false;
    protected $table = 'buku';
    protected $fillable = [
        'id', 'judul', 'pengarang', 'penerbit', 'tahun_terbit', 'kota',
    ];
}
