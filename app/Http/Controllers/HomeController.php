<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtener el usuario logueado
        $user = Auth::user();
        if ($user->id_rol == 1) {
            // Recoger todos los profesores y quitar a el propio profesor logueado
            $users = User::orderBy('apellidos')->where('id_rol', '=', 1)->where('id', '<>', $user->id)->get();
            return view('home_profesor', ['users' => $users]);
        } else {
            return view('home');
        }
    }
}
