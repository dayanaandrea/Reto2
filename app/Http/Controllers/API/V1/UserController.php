<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     description="A schema representing a user in the system. It includes personal details, contact information, and role assignment.",
 *     required={"name", "lastname", "email", "pin", "address", "phone1", "role_id"},
 *                 @OA\Property(property="name", type="string", description="The user's first name", example="Leire"),
 *                 @OA\Property(property="lastname", type="string", description="The user's last name", example="Lasa"),
 *                 @OA\Property(property="email", type="string", description="The user's email address", example="leire.lasa@elorrieta.com"),
 *                 @OA\Property(property="pin", type="string", description="The user's Personal Identification Number", example="11111111H"),
 *                 @OA\Property(property="address", type="string", description="The user's address", example="Main Street, 20, 3B"),
 *                 @OA\Property(property="phone1", type="string", description="The user's primary phone number", example="666666666"),
 *                 @OA\Property(property="phone2", type="string", description="The user's secondary phone number", example="666666666"),
 *                 @OA\Property(property="role_id", type="integer", description="The user's role ID", example=1)
 * )
 */
class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1.0/users",
     *     summary="Show users",
     *     description="Returns a list of all users with pagination data.",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="The page number to retrieve.",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="The number of results per page.",
     *         required=false,
     *         @OA\Schema(type="integer", default=10)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully retrieved the list of users.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="pagination", type="object",
     *                 @OA\Property(property="per_page", type="integer"),
     *                 @OA\Property(property="page", type="integer"),
     *                 @OA\Property(property="total_pages", type="integer"),
     *                 @OA\Property(property="total_items", type="integer")
     *             ),
     *             @OA\Property(property="users", type="array",
     *                 @OA\Items(ref="#/components/schemas/User")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
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
     * @OA\Post(
     *     path="/api/v1.0/users",
     *     summary="Create a new user",
     *     description="Creates a new user in the system.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User successfully created.",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
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
        unset($user->photo);

        return response()->json(['user' => $user], Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *     path="/api/v1.0/users/{id}",
     *     summary="Show a specific user",
     *     description="Fetches the details of a single user.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the user to retrieve.",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully retrieved the user details.",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found."
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function show(User $user)
    {
        unset($user->photo);
        return response()->json(['user' => $user], Response::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/api/v1.0/users/{id}",
     *     summary="Update an existing user",
     *     description="Updates an existing user in the system.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the user to update.",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully updated the user.",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found."
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
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
     * @OA\Delete(
     *     path="/api/v1.0/users/{id}",
     *     summary="Delete a specific user",
     *     description="Deletes a user from the system.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the user to delete.",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User successfully deleted.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found."
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function destroy(User $user)
    {
        $email = $user->email;
        $user->delete();
        return response()->json(['message' => 'User ' . $email . ' has been deleted.'], Response::HTTP_OK);
    }
}
