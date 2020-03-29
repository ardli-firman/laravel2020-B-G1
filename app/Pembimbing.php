<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    protected $table = 'pembimbing';

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'nim');
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'dosen_id');
    }
}
