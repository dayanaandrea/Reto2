<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener la paginación antes de realizar la consulta
        $pagination = getPagination($request);

        $users = User::orderBy('id')->paginate($pagination);

        // Quitar el campo de photo porque da errores
        foreach ($users as $user) {
            unset($user->photo);
        }

        // Obtener los datos de la paginación
        $paginationData = [
            'per_page' => $pagination,
            'page' => $users->currentPage(),
            'total_pages' => $users->lastPage(),
            'total_items' => $users->total(),
        ];

        // Retornar resultados + datos de la paginación
        return response()->json([
            'pagination' => $paginationData,
            'users' => $users->items(),
        ], Response::HTTP_OK);
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
        $user->phone2 = $request->has('phone2');
        $user->role_id = $request->role_id;
        $user->password = Hash::make('1234');

        // Guardar el nuevo usuario
        $user->save();
        unset($user->photo);

        return response()->json(['user' => $user], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        unset($user->photo);
        return response()->json(['user' => $user], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validar los datos del usuario
        validateUserUpdateAPI($request, $user);

        // Actualizar los datos, si se pasan, porque son nullables para permitir que solo se actualicen algunos
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('lastname')) {
            $user->lastname = $request->lastname;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        if ($request->has('pin')) {
            $user->pin = $request->pin;
        }
        if ($request->has('address')) {
            $user->address = $request->address;
        }
        if ($request->has('phone1')) {
            $user->phone1 = $request->phone1;
        }
        if ($request->has('phone2')) {
            $user->phone2 = $request->phone2;
        }
        if ($request->has('role_id')) {
            $user->role_id = $request->role_id;
        }

        // Solo actualizar si ha habido cambios en el usuario
        if ($user->isDirty()) {
            $user->save();
            unset($user->photo);
            return response()->json(['user' => $user], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'No changes detected.'], Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $email = $user->email;
        $user->delete();
        return response()->json(['message' => 'User ' . $email . ' has been deleted.'], Response::HTTP_OK);
    }
}
