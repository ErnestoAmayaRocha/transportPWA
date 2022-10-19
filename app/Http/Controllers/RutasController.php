<?php

namespace App\Http\Controllers;

use App\Models\Rutas;
use Illuminate\Http\Request;

class RutasController extends Controller
{
    public function index()
    {
        $rutas = Rutas::all()->toJson();
        dd($rutas);
    }
}
