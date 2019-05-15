<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Graficas extends Controller
{
public function load(Request $request){
    $ejex = explode(",",$request['ejex']);
    $numX = count($ejex);

    $ejey = explode(",",$request['ejey']);
    $numY = count($ejey);

    return view('generacionGrafica/welcome')->with('ejex',$this->getColumns($ejex))->with('ejey',$this->getColumns($ejey))->with('numX',$numX)->with('numY',$ejey);
}

public function getColumns($ejex){
    return json_encode(array($ejex));

}
}
