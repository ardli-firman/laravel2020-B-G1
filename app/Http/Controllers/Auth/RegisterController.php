<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mahasiswa;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected $redirectTo = '/oke';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard('mahasiswa')->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    protected function guard()
    {
        return Auth::guard('mahasiswa');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nim' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:mahasiswa'],
            'nama' => ['required', 'string', 'max:255'],
            'semester' => ['required', 'string', 'max:1'],
            'kelas' => ['required', 'string', 'max:2'],
            'tahun' => ['required', 'string', 'max:4'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Mahasiswa::create([
            'nim' => $data['nim'],
            'email' => $data['email'],
            'nama' => $data['nama'],
            'semester' => $data['semester'],
            'kelas' => $data['kelas'],
            'tahun' => $data['tahun'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function registered(Request $request, $user)
    {
        return redirect()->route('registrasi.mahasiswa')->withSuccess('Silahkan cek email');
    }
}
