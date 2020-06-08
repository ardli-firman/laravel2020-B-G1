<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Dosen extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'dosen';

    protected $guarded = [];
    protected $guard = 'dosen';

    public function bimbing()
    {
        return $this->hasMany(Pembimbing::class);
    }

    // custom
    public function getGuardName()
    {
        return $this->guard;
    }
}
