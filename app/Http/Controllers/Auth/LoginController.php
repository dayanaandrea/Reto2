<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Bool_;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // se cambia luego

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Controla la redirección tras el login.
     * @param mixed $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated()
    {
        $user = Auth::user();
        $role = $user->role;

        if ($role && ($role->role == 'god' || $role->role == 'administrador')) {
            return redirect('/admin');
        } else {
            return redirect('/home');
        }
    }
}
