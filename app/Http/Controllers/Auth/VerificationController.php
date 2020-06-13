<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{

    use VerifiesEmails;

    protected $redirectTo = '/home';
    private $authService;
    private $guardLogin;

    public function __construct(Request $request, AuthService $authService)
    {
        $guards = ['admin', 'mahasiswa', 'kaprodi', 'dosen'];
        $this->authService = $authService;
        $guardLogin = $this->authService->getGuardById($request->id);
        foreach ($guards as $guard) {
            if ($guardLogin == $guard) {
                $this->middleware("auth:{$guard}");
            }
        }
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        $guard = $this->authService->getGuardNameByLogin();
        return Auth::guard($guard)->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('auth.verify');
    }

    public function resend(Request $request)
    {
        $guard = $this->authService->getGuardNameByLogin();
        if (Auth::guard($guard)->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        Auth::guard($guard)->user()->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }
}
