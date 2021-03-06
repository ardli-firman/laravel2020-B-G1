<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    use AuthenticatesUsers;
    private $authService;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        $data = $this->validateLogin($request);
        $res = $this->authService->login($data);

        // $mhsLogin = preg_match("/(([0-9]){8})/", $data['username']);
        // if ($mhsLogin) {
        //     $res = $this->authService->mahasiswaLogin($data);
        // } else {
        //     $res = $this->authService->pengurusLogin($data);
        // }
        if ($res) {
            return redirect()->route('home');
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        return $request->validate([
            $this->username() => ['required', 'string', 'regex:/(([0-9]){8})|(^.+@.+$)/'],
            'password' => 'required|string',
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => "Credentials not found",
        ]);
    }
}
