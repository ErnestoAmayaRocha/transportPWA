<?php

namespace App\Http\Controllers;

use App\Models\Recorridos;
use Illuminate\Http\Request;

class RecorridosController extends Controller
{
    public function index()
    {
        $recorridos =Recorridos::all()->toArray();
        dd($recorridos);
    }
}
