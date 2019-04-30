<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\View\View;


class GeneracionIndicadores extends Controller
{
    public function index() {
        $tablas = DB::select('SHOW TABLES');
        $contador=0;
        foreach ($tablas as $valor)
            $devolver[$contador][0] = head($tablas[$contador]);
            $devolver[$contador][1] = $this->getCampos($devolver[$contador][0]);
            $contador++;
            
        return view('generacionIndicadores/welcome')->with('tablas', $devolver);
    }

    public function getCampos($nombre)
    {
        $tablas = DB::select('DESCRIBE '.$nombre);
        return $tablas;
    }
}
