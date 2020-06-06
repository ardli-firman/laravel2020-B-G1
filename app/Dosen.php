<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Dosen extends Authenticatable
{
    use Notifiable;

    protected $table = 'dosen';

    protected $guarded = [];
    protected $guard = 'dosen';

    public function bimbing()
    {
        return $this->hasMany(Pembimbing::class);
    }
}
