<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Meeting;
use App\Models\Cycle;
use App\Models\Module;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    public function homeAdmin(Request $request)
    {
        $user = Auth::user();


        if ($user->role) {
            $role = $user->role;
            if ($role->role == 'god' || $role->role == 'administrador') {


                $alumnoRole = Role::where('role', 'estudiante')->first();
                if ($alumnoRole) {
                    $totalAlumnos = User::where('role_id', $alumnoRole->id)->count();
                } else {
                    $totalAlumnos = 0;
                }


                $personalRole = Role::where('role', 'profesor')->first();
                if ($personalRole) {
                    $totalPersonal = User::where('role_id', $personalRole->id)->count();
                } else {
                    $totalPersonal = 0;
                }


                $today = Carbon::today();


                // Contar reuniones aceptadas y pendientes desde hoy
                $currentDay = getCurrentDay();
                $currentWeek = getCurrentWeek();
                $reunionesAccepted = Meeting::where('day', '=', $currentDay)->where('week', '=', $currentWeek)->where('status', 'aceptada')->count();
                $reunionesPendientes = Meeting::where('day', '=', $currentDay)->where('week', '=', $currentWeek)->where('status', 'pendiente')->count();
                $reunionesTotales = Meeting::where('day', '=', $currentDay)->where('week', '=', $currentWeek)->count();



                $totalCiclos = Cycle::count();
                $usuariosSinRol = User::whereNull('role_id')->count();
                $totalModulos = Module::count();


                return view('admin.home',  compact(
                    'totalAlumnos',
                    'totalPersonal',
                    'reunionesAccepted',
                    'reunionesPendientes',
                    'reunionesTotales',
                    'totalCiclos',
                    'usuariosSinRol',
                    'totalModulos'
                ));
            }
        }


        abort(404);
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
