<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cycle;

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
    public function home()
    {
        // Obtener el usuario logueado
        $user = Auth::user();
        if ($user->role) {
            $role = $user->role;

            if ($role->role == 'profesor') {
                $teachers = User::orderBy('lastname')->where('role_id', '=', 1)->paginate(5);
                return view('open.home', ['teachers' => $teachers]);
            } elseif ($role->role == 'estudiante') {
                return view('open.home');
            } elseif ($role->role == 'god' || $role->role == 'administrador') {
                return redirect('/admin/home');
            }
        } else {
            // Lanzar page not found
            abort(404);
        }
    }

    public function homeAdmin()
    {
        // Obtener el usuario logueado
        $user = Auth::user();
        if ($user->role) {
            $role = $user->role;
            if ($role->role == 'god' || $role->role == 'administrador') {
                return view('admin.home');
            }
        } else {
            // Lanzar page not found
            abort(404);
        }
    }

    public function teachers()
    {
        if (Auth::user()->role->role == 'profesor') {
            $teachers = User::orderBy('lastname')->where('role_id', '=', 1)->paginate(config('app.pagination', 10));
            return view('open.teachers', ['teachers' => $teachers]);
        }
    }
    public function cycles()
    {
        if (Auth::user()->role->role == 'profesor') {
            $cycles = Cycle::orderBy('code')->get();
            return view('open.cycles', ['cycles' => $cycles]);
        }
    }
    public function students()
    {
        if (Auth::user()->role->role == 'profesor') {
            $students = User::orderBy('lastname')->where('role_id', '=', 2)->paginate(config('app.pagination', 10));
            return view('open.students', ['students' => $students]);
        }
    }
}
