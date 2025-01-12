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
    public function index()
    {
        // Paginar, para no mostrar todos de golpe
        $users = User::orderBy('created_at', 'desc')->paginate(10, ['*'], 'active');
        $del_users = User::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10, ['*'], 'inactive');
        return view('admin.users.index', ['users' => $users, 'del_users' => $del_users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Datos que queremos pasar a la vista
        $roles = Role::orderBy('id')->get();

        // Pasar los datos a la vista usando with()
        return view('admin.users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        $user->role_id = $request->role_id;
        $user->password = Hash::make('1234');

        // Guardar el nuevo usuario
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Usuario <b>' . $user->email . '</b> creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Esto es para controlar lo que se puede ver en el perfil. Si es estudiante solo puede ver su perfil.
        if ((Auth::user()->role && (Auth::user()->role->role == 'estudiante')) && (Auth::check() && $user->id != Auth::user()->id)) {
            abort(404);
        }

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
        return view('admin.users.edit', ['roles' => $roles, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validar los datos del usuario
        validateUser($request, $user);

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->pin = $request->pin;
        $user->address = $request->address;
        $user->phone1 = $request->phone1;
        $user->phone2 = $request->has('phone2') ? $request->phone2 : $user->phone2;
        $user->role_id = $request->role_id;

        try {
            // Guardar el nuevo usuario
            $user->save();
            return redirect()->route('admin.users.show', $user)->with('success', 'Usuario <b>' . $user->email . '</b> actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.show', $user)->with('error', 'Error al actualizar el usuario <b>' . $user->email . '</b>X.');
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

        return redirect()->route('admin.users.index', $user)->with('success', 'Contraseña del usuario <b>' . $user->email . '</b> restablecida correctamente.');
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
            return back()->with('permission', 'No tienes permiso para cambiar la contraseña de este usuario.');
        }

        $this->validatePass($request);

        // Verificar si la contraseña actual es correcta
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.'])->withInput();
        }

        $user->password = Hash::make($request->new_password);

        // Guardar el nuevo usuario
        $user->save();

        return redirect()->route('admin.users.show', $user)->with('success', 'Contraseña actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (!($user->role) || ($user->role->role == 'god' && Auth::user()->role->role != 'god')) {
            return redirect()->route('admin.users.index')->with('permission', 'No tiene permisos para eliminar el usuario <b>' . $user->email . '</b>.');
        } else {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Usuario <b>' . $user->email . '</b> eliminado correctamente.');
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
            'new_password.regex' => 'La contraseña debe contener al menos una letra, un número y un carácter especial.',
            'new_password.confirmed' => 'Las contraseñas no coinciden.',
            'new_password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'new_password.max' => 'La contraseña no puede tener más de 255 caracteres.',
            'new_password_confirmation.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'new_password_confirmation.max' => 'La contraseña no puede tener más de 255 caracteres.',
        ]);
    }
}
