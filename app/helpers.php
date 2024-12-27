<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
