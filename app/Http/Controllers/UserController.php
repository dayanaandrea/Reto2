<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Paginar, para no mostrar todos de golpe
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        $del_users = User::orderBy('deleted_at', 'desc')->withTrashed()->whereNotNull('deleted_at')->paginate(10);
        return view('admin.users.index',['users' => $users, 'del_users' => $del_users]);
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
        $user->photo = $request->has('photo');
        $user->role_id = $request->role_id;
        $user->password = Hash::make('1234');

        // Guardar el nuevo usuario
        $user->save();
    
        return redirect()->route('admin.users.index')->with('success', 'Usuario ' . $user->email . ' creado correctamente.');
    }    

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show',['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $email = $user->email;
        $user->delete();
        return view('admin.users.success', ['email'=>$email]);
    }
}