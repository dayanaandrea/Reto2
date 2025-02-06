<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rolFiltro = $request->get('role', '');

        $user = User::orderBy('id', 'desc');

        if ($rolFiltro) {
            if ($rolFiltro === 'estudiante') {
                $user->whereHas('role', function ($query) {
                    $query->where('role', 'estudiante');
                });
            } elseif ($rolFiltro === 'profesor') {
                $user->whereHas('role', function ($query) {
                    $query->where('role', 'profesor');
                });
            } elseif ($rolFiltro === 'sin_rol') {
                $user->whereDoesntHave('role');
            }
        }

        $users = $user->paginate(10, ['*'], 'active');

        $del_users = User::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10, ['*'], 'inactive');

        return view('admin.users.index', compact('users', 'del_users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Datos que queremos pasar a la vista
        $roles = Role::orderBy('id')->get();

        // Pasar los datos a la vista usando with()
        return view('admin.users.create-edit', ['roles' => $roles, 'type' => 'POST']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->role_id == 0) {
            // Para que la validación no falle por que 0 no es válido
            $request->merge(['role_id' => null]);
        }
        // Validar los datos del usuario
        validateUser($request);
        // Crear el usuario
        $user = new User();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->pin = $request->pin;
        $user->address = $request->address;
        $user->phone1 = $request->phone1;
        $user->phone2 = $request->has('phone2') ? $request->phone2 : null;
        $user->intensive = $request->has('intensive') ? 1 : 0;
        $user->role_id = $request->has('role_id') ? $request->role_id : null;
        $user->password = Hash::make('1234');

        // Comprobar que solo el usuario god pùede añadir otros usuarios god
        if ($user->role->role == 'god' && Auth::user()->role->role != 'god') {
            return back()->with('error', 'No tienes permisos necesarios para crear un usuario con el rol seleccionado.');
        } else {
            try {
                // Guardar el nuevo usuario
                $user->save();
                return redirect()->route('admin.users.index')->with('success', __('user.controller_user')  . '<b>' . $user->email . '</b>' . __('user.controller_create'));
            } catch (\Exception $e) {
                return back()->with('error', __('user.controller_error_create'));
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Datos que queremos pasar a la vista
        $roles = Role::orderBy('id')->get();

        // Pasar los datos a la vista usando with()
        return view('admin.users.create-edit', ['roles' => $roles, 'user' => $user, 'type' => 'PUT']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Evitar que se añada el rol god si el usuario no es god
        // Evitar que se edite un usuario god si no es god con id 1
        if (($request->role_id == 4 && Auth::user()->role->role != 'god') || ($user->role && $user->role->role == 'god' && Auth::user()->role->id != 1)) {
            return back()->with('error', 'No tienes los permisos necesarios.');
        } else {
            if ($request->role_id == 0) {
                // Para que la validación no falle por que 0 no es válido
                $request->merge(['role_id' => null]);
            }
            // Validar los datos del usuario
            validateUser($request, $user);
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->pin = $request->pin;
            $user->address = $request->address;
            $user->phone1 = $request->phone1;
            $user->phone2 = $request->has('phone2') ? $request->phone2 : $user->phone2;
            $user->intensive = $request->has('intensive') ? 1 : 0;
            $user->role_id = $request->has('role_id') ? $request->role_id : null;

            try {
                // Guardar el nuevo usuario
                $user->save();
                return redirect()->route('admin.users.show', $user)->with('success', __('user.controller_user')  . '<b>'  . $user->email . '</b> ' . __('user.controller_edit'));
            } catch (\Exception $e) {
                return back()->with('error',  __('user.controller_error_edit') . ' <b>' . $user->email . '</b>.');
            }
        }
    }

    /**
     * Reset the password to 1234.
     */
    public function reset(User $user)
    {
        $user->password = Hash::make('1234');

        // Guardar el nuevo usuario
        $user->save();

        return redirect()->route('admin.users.index', $user)->with('success', __('user.controller_pass') . ' <b>' . $user->email . '</b> ' . __('user.controller_pass_2'));
    }

    /**
     * Change the current password.
     */
    public function changePass(User $user)
    {
        return view('admin.users.change-pass', ['user' => $user]);
    }

    /**
     * Store the new password.
     */
    public function storePass(Request $request, User $user)
    {
        // Verificar si el usuario logueado es el mismo que el usuario cuya contraseña se quiere cambiar
        if (Auth::user()->id !== $user->id) {
            return back()->with('permission',  __('user.controller_pass_change'));
        }

        $this->validatePass($request);

        // Verificar si la contraseña actual es correcta
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' =>  __('user.controller_incorrect_pass')])->withInput();
        }

        $user->password = Hash::make($request->new_password);

        // Guardar el nuevo usuario
        $user->save();

        return redirect()->route('admin.users.show', $user)->with('success',  __('user.controller_update_pass'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Los usuarios god no pueden ser eliminados por nadie
        if ($user->role->role == 'god') {
            return redirect()->route('admin.users.index')->with('permission',  __('user.controller_delete') . ' <b>' . $user->email . '</b>.');
        } else {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', __('user.controller_user')  . '<b>' . $user->email . '</b>' . __('user.controller_delete_2'));
        }
    }

    private function validatePass(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            // Confirmed busca automáticamente un campo con el nombre new_password_confirmation
            'new_password' => [
                'required',
                'min:8',
                'max:255',
                'confirmed',
                'regex:/[A-Za-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'new_password_confirmation' => 'required',
        ], [
            // Mensajes de error personalizados según lo que falle
            'new_password.regex' =>  __('user.new_password_regex'),
            'new_password.confirmed' => __('user.new_password_confirmed'),
            'new_password.min' => __('user.new_password_min'),
            'new_password.max' => __('user.new_password_max'),
            'new_password_confirmation.min' => __('user.new_password_confirmation_min'),
            'new_password_confirmation.max' => __('user.new_password_confirmation_max'),
        ]);
    }
}
