<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';
    protected $guarded = [];
    protected $guard = 'admin';

    // custom
    public function getGuardName()
    {
        return $this->guard;
    }
}
