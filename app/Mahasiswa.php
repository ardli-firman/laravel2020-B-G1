<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'mahasiswa';

    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = ['remember_token'];
    protected $guard = 'mahasiswa';

    protected $fillable = [
        'nim', 'email', 'nama', 'semester', 'kelas', 'tahun', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function judul_tugas_akhir()
    {
        return $this->hasOne(JudulTugasAkhir::class, 'nim');
    }

    public function pembimbing()
    {
        return $this->hasMany(Pembimbing::class, 'nim');
    }
}
