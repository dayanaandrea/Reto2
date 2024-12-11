<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function indexProfesores()
    {
        $users = User::orderBy('apellidos')->where('id_rol', 1)->get();
        return view('index_profesores',['users' => $users]);
    }
}
