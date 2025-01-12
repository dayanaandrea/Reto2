<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;

/**
 * Retorna un string que contiene el valor del atributo src de una etiqueta img de HTML.
 * Si tiene foto se codifica en base64 y sino, se coge la ruta de una imagen por defecto de storage.
 * 
 * @return string
 */
function obtenerFoto($user)
{
    // Comprobar si el usuario tiene una foto
    if ($user->photo != null) {
        // Si tiene foto, la codificamos en base64
        $image = base64_encode($user->photo);
        return "data:image/jpeg;base64,{$image}";
    } else {
        // Si no tiene foto, se devuelve una imagen por defecto
        return Storage::url('public/images/user.png');
    }
}

function obtenerEstiloRol($role)
{
    if ($role) {
        if ($role == 'god') {
            return 'bg-danger';
        } elseif ($role == 'administrador') {
            return 'bg-warning';
        } elseif ($role == 'profesor') {
            return 'bg-primary';
        } elseif ($role == 'estudiante') {
            return 'bg-success';
        } else {
            return 'bg-dark';
        }
    } else {
        return 'bg-light';
    }

}

function getPagination(Request $request): int
{
    // Obtener la paginación de request y si no hay valor, coger la variable pagination que por defecto es 10
    $pagination = intval($request->get('per_page', config('app.pagination', 10)));

    // Si el valor de paginación no es válido, no es un número, intval devuelve 0
    if ($pagination <= 0) {
        // Se establece el valor por defecto, como en el caso previo
        $pagination = intval(config('app.pagination', 10));
    }

    return $pagination;
}

function validateRole(Request $request)
{
    $request->validate([
        'role' => 'required|min:10|max:50',
        'description' => 'required|min:10|max:255'
    ], [
        // Mensajes de error personalizados según lo que falle
        'role.required' => 'El nombre del rol es obligatorio.',
        'description.required' => 'La descripción del rol es obligatoria.',
        'description.min' => 'La descripción debe tener al menos 10 caracteres.',
        'description.max' => 'La descripción no puede tener más de 255 caracteres.',
    ]);
}

function validateRoleUpdateAPI(Request $request)
{
    $request->validate([
        'role' => 'nullable|min:10|max:50',
        'description' => 'nullable|min:10|max:255'
    ]);
}

function validateUser(Request $request, $user = null)
{
    // Excluir el email del usuario actual durante la actualización
    $emailValidation = 'required|email|unique:users,email,' . ($user ? $user->id : 'NULL') . '|max:255';

    $request->validate([
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => $emailValidation,
        'pin' => [
            'required',
            'string',
            'min:9',
            'max:9',
            'regex:/^[XYZ]?\d{7}[A-Za-z]$|^\d{8}[A-Za-z]$/', // Validación para DNI o NIE
        ],
        'address' => 'required|string|max:255',
        'phone1' => 'required|string|max:15',
        'phone2' => 'nullable|string|max:15',
        'role_id' => 'required|exists:roles,id',
    ], [
        // Mensajes de error personalizados
        'name.required' => 'El nombre es obligatorio.',
        'name.max' => 'El nombre no puede tener más de 255 caracteres.',
        'lastname.required' => 'El apellido es obligatorio.',
        'lastname.max' => 'El apellido no puede tener más de 255 caracteres.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'El correo electrónico debe ser válido.',
        'email.unique' => 'El correo electrónico ya está en uso. Por favor, elige otro.',
        'pin.required' => 'El DNI/NIE es obligatorio.',
        'pin.min' => 'El DNI/NIE debe tener 9 caracteres.',
        'pin.max' => 'El DNI/NIE no puede tener más de 9 caracteres.',
        'pin.regex' => 'Un DNI tiene 8 dígitos seguidos de una letra, o un NIE tiene una letra inicial seguida de 7 dígitos y una letra al final.',
        'address.required' => 'La dirección es obligatoria.',
        'address.max' => 'La dirección no puede tener más de 255 caracteres.',
        'phone1.required' => 'El número de teléfono principal es obligatorio.',
        'phone1.max' => 'El número de teléfono principal no puede tener más de 15 caracteres.',
        'phone2.max' => 'El número de teléfono secundario no puede tener más de 15 caracteres.',
        'role_id.required' => 'El rol es obligatorio.',
        'role_id.exists' => 'El rol seleccionado no existe.',
    ]);
}

function validateUserUpdateAPI(Request $request, User $user)
{
    // Excluir el email del usuario actual durante la actualización
    $emailValidation = 'nullable|email|unique:users,email,' . ($user ? $user->id : 'NULL') . '|max:255';

    $request->validate([
        'name' => 'nullable|string|max:255',
        'lastname' => 'nullable|string|max:255',
        'email' => $emailValidation,
        'pin' => [
            'nullable',
            'string',
            'min:9',
            'max:9',
            'regex:/^[XYZ]?\d{7}[A-Za-z]$|^\d{8}[A-Za-z]$/', // Validación para DNI o NIE
        ],
        'address' => 'nullable|string|max:255',
        'phone1' => 'nullable|string|max:15',
        'phone2' => 'nullable|string|max:15',
        'role_id' => 'nullable|exists:roles,id',
    ]);
}