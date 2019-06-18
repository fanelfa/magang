<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    public $incrementing = false;
    protected $table = 'siswa';
    protected $fillable = ['id','name','lahir','agama','alamat'];
}
