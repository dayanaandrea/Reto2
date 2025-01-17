<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function showVersion()
    {
        return response()->json(['message' => 'Bienvenido a la API versión 2.0']);
    }
}
