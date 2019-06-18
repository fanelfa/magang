<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    public $incrementing = false;
    protected $table = 'guru';
    protected $fillable = [
        'id', 'name', 'lahir', 'nip', 'alamat',
    ];
}
