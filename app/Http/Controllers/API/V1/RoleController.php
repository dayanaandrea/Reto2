<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @OA\Schema(
 *     schema="Role",
 *     type="object",
 *     required={"role", "description"},
 *     @OA\Property(property="role", type="string", example="admin"),
 *     @OA\Property(property="description", type="string", example="Administrator role")
 * )
 */
class RoleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1.0/roles",
     *     summary="Show roles",
     *     description="Returns a list of all roles with pagination data.",
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
     *         description="Successfully retrieved the list of roles.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="pagination", type="object",
     *                 @OA\Property(property="per_page", type="integer"),
     *                 @OA\Property(property="page", type="integer"),
     *                 @OA\Property(property="total_pages", type="integer"),
     *                 @OA\Property(property="total_items", type="integer")
     *             ),
     *             @OA\Property(property="roles", type="array",
     *                 @OA\Items(ref="#/components/schemas/Role")
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

        $roles = Role::orderBy('id')->paginate($pagination);

        // Obtener los datos de la paginación
        $paginationData = [
            'per_page' => $pagination,
            'page' => $roles->currentPage(),
            'total_pages' => $roles->lastPage(),
            'total_items' => $roles->total(),
        ];

        // Retornar resultados + datos de la paginación
        return response()->json([
            'pagination' => $paginationData,
            'roles' => $roles->items(),
        ], Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/api/v1.0/roles",
     *     summary="Create a new role",
     *     description="Creates a new role in the system.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"role", "description"},
     *                 @OA\Property(property="role", type="string"),
     *                 @OA\Property(property="description", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Role successfully created.",
     *         @OA\JsonContent(ref="#/components/schemas/Role")
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
        // Validar los datos
        validateRole($request);

        // Crear el rol
        $role = new Role();
        $role->role = strtolower($request->role);
        $role->description = $request->description;

        // Guardar el nuevo rol
        $role->save();

        return response()->json(['role' => $role], Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *     path="/api/v1.0/roles/{id}",
     *     summary="Show a specific role",
     *     description="Fetches the details of a single role.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the role to retrieve.",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully retrieved the role details.",
     *         @OA\JsonContent(ref="#/components/schemas/Role")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Role not found."
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function show(Role $role)
    {
        return response()->json(['role' => $role], Response::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/api/v1.0/roles/{id}",
     *     summary="Update an existing role",
     *     description="Updates an existing role in the system.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the role to update.",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="role", type="string"),
     *                 @OA\Property(property="description", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully updated the role.",
     *         @OA\JsonContent(ref="#/components/schemas/Role")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Role not found."
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function update(Request $request, Role $role)
    {
        validateRole($request);

        $role->role = strtolower($request->role);
        $role->description = $request->description;

        // Guardar el nuevo rol
        $role->save();

        return response()->json(['role' => $role], Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1.0/roles/{id}",
     *     summary="Delete a specific role",
     *     description="Deletes a role from the system.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the role to delete.",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Role successfully deleted.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Role not found."
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function destroy(Role $role)
    {
        $name = $role->role;
        $role->delete();
        return response()->json(['message' => 'Role ' . $name . ' has been deleted.'], Response::HTTP_OK);
    }
}

