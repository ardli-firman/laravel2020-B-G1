<?php

namespace App\Http\Controllers\Auth;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Http\Services\Kaprodi\KaprodiBaseService;
use App\Kaprodi;
use App\Mahasiswa;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterDosenController extends Controller
{
    protected $redirectTo = '/registrasi/dosen';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register_dos');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard('dosen')->login($user);

        return $this->registered($request, $user)
            ?: redirect()->route('registrasi.dosen')->withErrors('Gagal');
    }

    protected function guard()
    {
        return Auth::guard('dosen');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:kaprodi', 'unique:dosen'],
            'nama' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Dosen::create([
            'email' => $data['email'],
            'nama' => $data['nama'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function registered(Request $request, $user)
    {
        return redirect()->route('registrasi.dosen')->withSuccess('Silahkan cek email');
    }
}
