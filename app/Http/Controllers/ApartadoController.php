<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartado;

class ApartadoController extends Controller
{
    public function index()
    {
        return view('apartados.index');
    }
}
