<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Meeting;
use App\Models\Cycle;
use App\Models\Module;

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
                return view('home', ['teachers' => $teachers]);
            } elseif ($role->role == 'estudiante') {
                return view('home');
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

        // Verificar si el usuario tiene un rol y si es admin o god
        if ($user->role) {
            $role = $user->role;
            if ($role->role == 'god' || $role->role == 'administrador') {

                //Verificar para ssaber si hay alumnos, y si no hay que me aparezca 0 
                $alumnoRole = Role::where('role', 'estudiante')->first();
                if ($alumnoRole) {
                    $totalAlumnos = User::where('role_id', $alumnoRole->id)->count();
                } else {
                    $totalAlumnos = 0;
                }


                // Ciclos formativos
                $totalCiclos = Cycle::count();

                // Usuarios sin rol
                $usuariosSinRol = User::whereNull('role_id')->count();

                // Módulos
                $totalModulos = Module::count();

                // Pasar los datos a la vista
                return view('admin.home', compact(
                    'totalAlumnos',
                    'totalCiclos',
                    'usuariosSinRol',
                    'totalModulos'
                ));
            }
        }

        // Si el usuario no tiene rol adecuado, lanzar error
        abort(404);
    }
}
