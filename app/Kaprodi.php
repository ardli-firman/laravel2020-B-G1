<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Kaprodi extends Authenticatable
{
    use Notifiable;

    protected $table = 'kaprodi';

    protected $guarded = [];
    protected $guard = 'kaprodi';
}
