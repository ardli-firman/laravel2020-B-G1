<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Kaprodi extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'kaprodi';

    protected $guarded = [];
    protected $guard = 'kaprodi';

    // custom
    public function getGuardName()
    {
        return $this->guard;
    }
}
