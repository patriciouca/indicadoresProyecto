<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\View\View;


class GeneracionIndicadores extends Controller
{
    public function index() {
        $tablas = DB::select('SHOW TABLES');
        return view('generacionIndicadores/welcome')->with('tablas', $tablas);
    }

    public function getCampos($nombre)
    {
        $tablas = DB::select('DESCRIBE '.$nombre);
        return $tablas;
    }
}
