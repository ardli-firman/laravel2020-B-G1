<?php

namespace App\Http\Services;

use App\Admin;
use App\Dosen;
use App\Kaprodi;
use App\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    public function mahasiswaLogin($data)
    {
        $mhs['nim'] = $data['username'];
        $mhs['password'] = $data['password'];
        $res = $this->attemptLogin('mahasiswa', $mhs);
        if ($res) {
            return $mhs;
        }
        return false;
    }

    public function pengurusLogin($data)
    {
        $guard = null;

        $pengurus['email'] = $data['username'];
        $pengurus['password'] = $data['password'];

        $guard = $this->getAllEmail($pengurus);
        if ($guard != null) {
            $res = $this->attemptLogin($guard, $pengurus);
            if ($res) {
                return $pengurus;
            }
        }
        return false;
    }

    public function attemptLogin($guard = null, $data = null)
    {
        return Auth::guard($guard)->attempt($data);
    }

    public function getAllEmail($user)
    {
        $guard = null;

        $admin = Admin::where('email', '=', $user['email'])->get();
        $dosen = Dosen::where('email', '=', $user['email'])->get();
        $kaprodi = Kaprodi::where('email', '=', $user['email'])->get();
        $mahasiswa = Mahasiswa::where('email', '=', $user['email'])->get();

        if (!$admin->isEmpty()) {
            $guard = 'admin';
        } elseif (!$dosen->isEmpty()) {
            $guard = 'dosen';
        } elseif (!$kaprodi->isEmpty()) {
            $guard = 'kaprodi';
        } elseif (!$mahasiswa->isEmpty()) {
            $guard = 'mahasiswa';
        }

        return $guard;
    }

    public function getGuardById($id)
    {
        $guard = null;

        $admin = Admin::where('id', '=', $id)->get();
        $dosen = Dosen::where('id', '=', $id)->get();
        $kaprodi = Kaprodi::where('id', '=', $id)->get();
        $mahasiswa = Mahasiswa::where('nim', '=', $id)->get();

        if (!$admin->isEmpty()) {
            $guard = 'admin';
        } elseif (!$dosen->isEmpty()) {
            $guard = 'dosen';
        } elseif (!$kaprodi->isEmpty()) {
            $guard = 'kaprodi';
        } elseif (!$mahasiswa->isEmpty()) {
            $guard = 'mahasiswa';
        }

        return $guard;
    }
}
