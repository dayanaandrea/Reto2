<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'pin' => ['required', 'string', 'size:9'],
            'address' => ['required', 'string', 'max:255'],
            'phone1' => ['required', 'string', 'max:20'],
            'role_id' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            // Pass por defecto 1234
            'password' => Hash::make('1234'),
            'pin' => $data['pin'],
            'address' => $data['address'],
            'phone1' => $data['phone1'],
            'phone2' => $data['phone2'],
            'created_at' => now(),
            'updated_at' => now(),
            'photo' => $data['photo'],
            'role_id' => $data['role_id'],
        ]);
    }

    public function showRegistrationForm()
    {
        // Datos que queremos pasar a la vista
        $roles = Role::orderBy('id')->get();
        
        // Pasar los datos a la vista usando with()
        return view('auth.register', ['roles' => $roles]);
    }
}
