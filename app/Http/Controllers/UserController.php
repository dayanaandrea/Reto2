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
        // Crear el usuario
        $user = new User();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->pin = $request->pin;
        $user->address = $request->address;
        $user->phone1 = $request->phone1;
        $user->phone2 = $request->has('phone2');
        $user->role_id = $request->role_id;
        $user->password = Hash::make('1234');

        // Comprobar si la imagen es válida
        $request->validate([
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // La imagen se guarda como binary en la base de datos
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageData = file_get_contents($image->getRealPath());
            $user->photo = $imageData;
        }

        // Guardar el nuevo usuario
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Usuario ' . $user->email . ' creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (Auth::user()->role->role === 'administrador' || Auth::user()->role->role === 'god' || Auth::user()->id === $user->id){
            return view('admin.users.show', ['user' => $user]);
        } else {
            return redirect("/home")->with('permission', 'No tienes permiso para acceder a la información de este usuario.');
        }
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
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->pin = $request->pin;
        $user->address = $request->address;
        $user->phone1 = $request->phone1;
        $user->phone2 = $request->has('phone2');
        $user->role_id = $request->role_id;

        // Comprobar si la imagen es válida
        $request->validate([
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // La imagen se guarda como binary en la base de datos
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageData = file_get_contents($image->getRealPath());
            $user->photo = $imageData;
        }

        // Guardar el nuevo usuario
        $user->save();

        return redirect()->route('admin.users.show', $user)->with('success', 'Usuario ' . $user->email . ' actualizado correctamente.');
    }

    /**
     * Reset the password to 1234.
     */
    public function reset(User $user)
    {
        $user->password = Hash::make('1234');

        // Guardar el nuevo usuario
        $user->save();

        return redirect()->route('admin.users.index', $user)->with('success', 'Contraseña del usuario ' . $user->email . ' restablecida correctamente.');
    }

    /**
     * Change the current password.
     */
    public function changePass(Request $request, User $user)
    {
        // Verificar si el usuario logueado es el mismo que el usuario cuya contraseña se quiere cambiar
        if (Auth::user()->id !== $user->id) {
            return redirect()->route('admin.users.show', $user)->with('permission', 'No tienes permiso para cambiar la contraseña de este usuario.');
        }

        $validated = $request->validate([
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
            'new_password.regex' => 'La nueva contraseña debe contener al menos una letra, un número y un carácter especial.',
            'new_password.confirmed' => 'La confirmación de la nueva contraseña no coincide con la nueva contraseña.',
            'new_password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'new_password.max' => 'La nueva contraseña no puede tener más de 255 caracteres.',
            'new_password_confirmation.min' => 'La confirmación de la nueva contraseña debe tener al menos 8 caracteres.',
            'new_password_confirmation.max' => 'La confirmación de la nueva contraseña no puede tener más de 255 caracteres.',
        ]);

        // Verificar si la contraseña actual es correcta
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.'])->withInput();
        }

        $user->password = Hash::make($request->password);

        // Guardar el nuevo usuario
        $user->save();

        if (Auth::user()->role && (Auth::user()->role->role === 'administrador' || Auth::user()->role->role === 'god')){
            return redirect()->route('admin.users.show', $user)->with('success', 'Contraseña actualizada correctamente.');
        } else {
            return redirect()->route('users.show', $user)->with('success', 'Contraseña actualizada correctamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->role){
            if ($user->role->role == 'god'){
                return redirect()->route('admin.users.index')->with('permission', 'No tiene permisos para eliminar el usuario ' . $user->email . '.');
            }
        } else {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Usuario ' . $user->email . ' eliminado correctamente.');
        }
    }
}
