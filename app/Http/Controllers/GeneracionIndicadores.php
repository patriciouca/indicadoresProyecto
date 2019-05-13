<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Session;


class GeneracionIndicadores extends Controller
{
    public function inicial(){
        config(['database.connections.mysql.database'=>session('base')]);
    }

    public function getTablasCampos(){
        $this->inicial();

        $tablas = DB::select('SHOW TABLES');
        $contador=0;
        foreach ($tablas as $valor)
        {
            $devolver[$contador][0] = head($tablas[$contador]);
            $devolver[$contador][1] = $this->getCampos($devolver[$contador][0]);
            $contador++;
        }


        return $devolver;
    }

    public function index() {

        return view('generacionIndicadores/welcome')->with('tablas', $this->getTablasCampos());
    }

    public function getCampos($nombre)
    {
        $this->inicial();
        $tablas = DB::select('DESCRIBE '.$nombre);
        return $tablas;
    }

    public function getRelaciones()
    {
        $this->inicial();
        $tablas = DB::select('SELECT CONCAT( table_name, \'.\',
        column_name, \' -> \',
        referenced_table_name, \'.\',
        referenced_column_name ) AS list_of_fks
        FROM information_schema.KEY_COLUMN_USAGE
        WHERE REFERENCED_TABLE_SCHEMA = \'indicadoresproyecto\'
        AND REFERENCED_TABLE_NAME is not null
        ORDER BY TABLE_NAME, COLUMN_NAME ');
        $contador=0;
        foreach ($tablas as $tabla)
        {
            $devolver[$contador]=head($tablas[$contador]);
            $contador++;
        }
        return $devolver;
    }

    public function matrizCaminos(){

        $relaciones = array();
        $caminos = array();
        $relacionesRAW = $this->getRelaciones();

        //Generacion de un Array que almacene todas las relaciones en un formato mas comodo para trabajar
        foreach ($relacionesRAW as $relacionSinProcesar) {
            $tablasSeparadas = explode(' -> ', $relacionSinProcesar);
            $elementosRelacion1 = explode('.', $tablasSeparadas[0]);
            $elementosRelacion2 = explode('.', $tablasSeparadas[1]);
            array_push($relaciones, array(
                    "tabla1" => $elementosRelacion1[0],
                    "elemento1" => $elementosRelacion1[1],
                    "tabla2" => $elementosRelacion2[0],
                    "elemento2" => $elementosRelacion2[1]
                )
            );
        }

        $nombresTablas = $this->getTablasCampos();

        //Convertir $arrayAux en un array con el cual sea mas facil trabajar
        for ($i = 0; $i < count($nombresTablas); $i++) {
            $nombresTablas[$i] = $nombresTablas[$i][0];
        }

        foreach ($nombresTablas as $tabla1) {
            $caminos[$tabla1] = array();
            foreach ($nombresTablas as $tabla2) {
                $caminos[$tabla1][$tabla2] = "";
            }
        }

        //Guardando relaciones directas entre tablas
        foreach ($relaciones as $r) {
            $caminos[$r["tabla1"]][$r["tabla2"]] = $r["tabla2"];
            $caminos[$r["tabla2"]][$r["tabla1"]] = $r["tabla1"];

        }

        //Guardando caminos reflexivos triviales
        foreach ($nombresTablas as $tabla) {
            $caminos[$tabla][$tabla] = $tabla;
        }

        //Guardando conexion entre las distintas tablas
        foreach ($nombresTablas as $tabla3) {
            foreach ($nombresTablas as $tabla1) {
                foreach ($nombresTablas as $tabla2) {
                    if ($caminos[$tabla1][$tabla2] == "") {
                        if ($caminos[$tabla1][$tabla3] != "" && $caminos[$tabla3][$tabla2] != "") {
                            $caminos[$tabla1][$tabla2] = $tabla3;
                        }
                    }
                }
            }
        }

        return array($relaciones,$caminos);
    }

    function encontrarRelacion($tabla1, $tabla2){
        $relaciones = session('relaciones');
        foreach ($relaciones as $r){
            if(($r["tabla1"]==$tabla1 && $r["tabla2"]==$tabla2) || ($r["tabla2"]==$tabla1 && $r["tabla1"]==$tabla2))
                return $r;
        }
        return null;
    }

    function encontrarRelaciones($tabla1, $tabla2){
        $relaciones = session('relaciones');
        $relacionesEntreTablas = array();
        foreach ($relaciones as $r){
            if(($r["tabla1"]==$tabla1 && $r["tabla2"]==$tabla2) || ($r["tabla2"]==$tabla1 && $r["tabla1"]==$tabla2))
                array_push($relacionesEntreTablas, $r);
        }
        return $relacionesEntreTablas;
    }

    public function camino($tabla1, $tabla2){
        $grafoTablas = session('grafoTablas');
        $tablaActual = $tabla1;
        $from = array();
        $where = array();

        //Guarda en el array $from todas las tablas involucradas en el camino, empezsando por tabla2 y acabando en tabla 1
        while($tablaActual != $tabla2){
            array_push($from, $tablaActual);
            $tablaActual = $grafoTablas[$tablaActual][$tabla2];
        }
        array_push($from, $tablaActual);

        $nTablas = sizeof($from);
        //Generacion de las distintas clausulas where para unir las tablas
        //Version de varias relaciones entre dos tablas
        for($i=0; $i<$nTablas-1; $i++){
            $relaciones = $this->encontrarRelaciones($from[$i], $from[$i+1]);
            while(sizeof($relaciones) > 0) {
                $r = array_pop($relaciones);
                $string = $r["tabla1"] . "." . $r["elemento1"] . "=" . $r["tabla2"] . "." . $r["elemento2"];
                array_push($where, $string);
            }
        }
        //Version de una unica relacion entre dos tablas
        /*for($i=0; $i<$nTablas-1; $i++){
            $r = $this->encontrarRelacion($from[$i], $from[$i+1]);
            $where[$i] = $r["tabla1"] . "." . $r["elemento1"] . "=" . $r["tabla2"] . "." . $r["elemento2"];
        }*/

        return array("from" => $from, "where" => $where);
    }

    /*
    public function generateSql(Request $request){
        $this->inicial();
        $sCampos=$request['campos'];
       $sSql = "SELECT ";
       $sSqlFrom = " FROM ";
       $tablas=[];

        foreach ($sCampos as $valor)
        {
            switch($valor) {

                case "+":
                    $sSql = $sSql . "+";
                    break;

                case "-":
                    $sSql = $sSql . "-";
                    break;

                case "*":
                    $sSql = $sSql . "*";
                    break;

                case "/":
                    $sSql = $sSql . "/";
                    break;

                case "contar(":
                    $sSql = $sSql . "count(";
                    break;

                case ")":
                    $sSql = $sSql . ")";
                    break;

                case "(":
                    $sSql = $sSql . "(";
                    break;

                default:
                    $tmp =  explode(".", $valor);
                    if(sizeof($tmp)==2)
                    {

                        if(array_search($tmp[0],$tablas)==false)
                        {
                            array_push($tablas,array_search($tmp[0],$tablas));
                            array_push($tablas,$tmp[0]);

                            $sSqlFrom = $sSqlFrom . $tmp[0] . ",";
                        }
                        $sSql = $sSql . $tmp[1];
                    }
                    else
                        return var_dump($tmp);
            }
        }
       $sSqlFrom = substr($sSqlFrom,0,strlen($sSqlFrom)-1);
       $sSqlDef  = $sSql.$sSqlFrom;
       return $sSqlDef;
    }

    public function generateSql2(Request $request){
        $this->inicial();
        $sCampos=explode(",",$request['campos']);
        $sCampos2=explode(",",$request['campos2']);
        $sSql = "SELECT ";
        $sSqlFrom = " FROM ";
        $sSqlGroup = "";
        $tablas=[];
        $sSqlGroupT =false;

        foreach ($sCampos as $valor)
        {
            switch($valor) {

                case "+":
                    $sSql = $sSql . "+";
                    break;

                case "-":
                    $sSql = $sSql . "-";
                    break;

                case "*":
                    $sSql = $sSql . "*";
                    break;

                case "/":
                    $sSql = $sSql . "/";
                    break;

                case "contar(":
                    $sSql = $sSql . "count(";
                    $sSqlGroupT=true;
                    break;

                case ")":
                    $sSql = $sSql . ")";
                    break;

                case "(":
                    $sSql = $sSql . "(";
                    break;

                default:
                    $tmp =  explode(".", $valor);
                    if(sizeof($tmp)==2)
                    {
                        if($sSqlGroupT)
                        {
                            $sSqlGroup.=$tmp[0].".".$tmp[1];
                            $sSqlGroupT=false;
                        }

                        if(array_search($tmp[0],$tablas)==false)
                        {
                            array_push($tablas,array_search($tmp[0],$tablas));
                            array_push($tablas,$tmp[0]);

                            $sSqlFrom = $sSqlFrom . $tmp[0] . ",";
                        }
                        $sSql = $sSql . $tmp[1];
                    }
                    else
                        return var_dump($tmp);
            }
        }
        $sSql = $sSql . ",";
        foreach ($sCampos2 as $valor)
        {
            switch($valor) {

                case "+":
                    $sSql = $sSql . "+";
                    break;

                case "-":
                    $sSql = $sSql . "-";
                    break;

                case "*":
                    $sSql = $sSql . "*";
                    break;

                case "/":
                    $sSql = $sSql . "/";
                    break;

                case "contar(":
                    $sSql = $sSql . "count(";
                    $sSqlGroupT=true;
                    break;

                case ")":
                    $sSql = $sSql . ")";
                    break;

                case "(":
                    $sSql = $sSql . "(";
                    break;

                default:
                    $tmp =  explode(".", $valor);
                    if(sizeof($tmp)==2)
                    {
                        if($sSqlGroupT)
                        {
                            $sSqlGroup.=$tmp[0].".".$tmp[1];
                            $sSqlGroupT=false;
                        }

                        if(array_search($tmp[0],$tablas)==false)
                        {
                            array_push($tablas,array_search($tmp[0],$tablas));
                            array_push($tablas,$tmp[0]);

                            $sSqlFrom = $sSqlFrom . $tmp[0] . ",";
                        }
                        $sSql = $sSql . $tmp[1];
                    }
                    else
                        return var_dump($tmp);
            }
        }
        $sSqlFrom = substr($sSqlFrom,0,strlen($sSqlFrom)-1);
        $sSqlDef  = $sSql.$sSqlFrom;
        if($sSqlGroup != "")
            $sSqlDef.=" GROUP BY (".session('base').".".$sSqlGroup;

        $tablas = DB::select($sSqlDef);

        return view('generacionIndicadores/tabla')->with('tablas', $tablas)->with('consulta', $sSqlDef);
    }
    */

    public function generateSqlBienFormada(Request $request)
    {
        $this->inicial();
        $sCampos=explode(",",$request['campos']);
        $sCampos2=explode(",",$request['campos2']);

        $sSql="";
        $consulta=[];
        $sSqlGroup = [];
        $tablas=[];
        $sSqlGroupT =false;

        foreach ($sCampos as $valor)
        {
            switch($valor) {

                case "+":
                    $sSql = $sSql . "+";
                    break;

                case "-":
                    $sSql = $sSql . "-";
                    break;

                case "*":
                    $sSql = $sSql . "*";
                    break;

                case "/":
                    $sSql = $sSql . "/";
                    break;

                case "contar(":
                    $sSql = $sSql . "count(";
                    $sSqlGroupT=true;
                    break;

                case ")":
                    $sSql = $sSql . ")";
                    break;

                case "(":
                    $sSql = $sSql . "(";
                    break;

                default:
                    $tmp =  explode(".", $valor);
                    if(sizeof($tmp)==2)
                    {
                        if($sSqlGroupT)
                        {
                            array_push($sSqlGroup,$tmp[0].".".$tmp[1]);
                            //$sSqlGroup.=$tmp[0].".".$tmp[1];
                            $sSqlGroupT=false;
                        }

                        if(array_search($tmp[0],$tablas)==false)
                        {
                            array_push($tablas,array_search($tmp[0],$tablas));
                            array_push($tablas,$tmp[0]);
                        }
                        $sSql = $sSql . $tmp[1];
                    }
                    else
                        return var_dump($tmp);
            }

        }
        array_push($consulta,$sSql);
        $sSql = "";
        foreach ($sCampos2 as $valor)
        {
            switch($valor) {

                case "+":
                    $sSql = $sSql . "+";
                    break;

                case "-":
                    $sSql = $sSql . "-";
                    break;

                case "*":
                    $sSql = $sSql . "*";
                    break;

                case "/":
                    $sSql = $sSql . "/";
                    break;

                case "contar(":
                    $sSql = $sSql . "count(";
                    $sSqlGroupT=true;
                    break;

                case ")":
                    $sSql = $sSql . ")";
                    break;

                case "(":
                    $sSql = $sSql . "(";
                    break;

                default:
                    $tmp =  explode(".", $valor);
                    if(sizeof($tmp)==2)
                    {
                        if($sSqlGroupT)
                        {
                            array_push($sSqlGroup,$tmp[0].".".$tmp[1]);
                            //$sSqlGroup.=$tmp[0].".".$tmp[1];
                            $sSqlGroupT=false;
                        }

                        if(array_search($tmp[0],$tablas)==false)
                        {
                            array_push($tablas,array_search($tmp[0],$tablas));
                            array_push($tablas,$tmp[0]);
                        }
                        $sSql = $sSql . $tmp[1];
                    }
                    else
                        return var_dump($tmp);
            }

        }
        array_push($consulta,$sSql);

        $db=DB::table($tablas[1]);
        $seleccionar="";
        foreach ($consulta as $consulti)
        {
            $seleccionar.=$consulti.",";
        }
        $seleccionar = substr($seleccionar,0,strlen($seleccionar)-1);
        $db->select(DB::raw($seleccionar));
        $db->groupBy($sSqlGroup);

        $consultar=$db->toSql();

        return view('generacionIndicadores/tabla')->with('tablas',  $db->get())->with('consulta', $consultar);

    }

    public function pruebagenerateSql2(Request $request){
        $this->inicial();
        $sCampos=explode(",",$request['campos']);
        $sCampos2=explode(",",$request['campos2']);
        $sSql = "SELECT ";
        $sSqlFrom = " FROM ";
        $sSqlWhere = " WHERE ";
        $sSqlGroup = "";
        $tablas=[];
        $sSqlGroupT =false;

        foreach ($sCampos as $valor)
        {
            switch($valor) {

                case "+":
                    $sSql = $sSql . "+";
                    break;

                case "-":
                    $sSql = $sSql . "-";
                    break;

                case "*":
                    $sSql = $sSql . "*";
                    break;

                case "/":
                    $sSql = $sSql . "/";
                    break;

                case "contar(":
                    $sSql = $sSql . "count(";
                    $sSqlGroupT=true;
                    break;

                case ")":
                    $sSql = $sSql . ")";
                    break;

                case "(":
                    $sSql = $sSql . "(";
                    break;

                default:
                    $tmp =  explode(".", $valor);
                    if(sizeof($tmp)==2)
                    {
                        if($sSqlGroupT)
                        {
                            $sSqlGroup.=$tmp[0].".".$tmp[1];
                            $sSqlGroupT=false;
                        }

                        if(array_search($tmp[0],$tablas)==false)
                        {
                            array_push($tablas,array_search($tmp[0],$tablas));
                            array_push($tablas,$tmp[0]);

                            //$sSqlFrom = $sSqlFrom . $tmp[0] . ",";
                        }
                        $sSql = $sSql . $tmp[0] . "." . $tmp[1];
                    }
                    else
                        return var_dump($tmp);
            }
        }
        $sSql = $sSql . ",";
        foreach ($sCampos2 as $valor)
        {
            switch($valor) {

                case "+":
                    $sSql = $sSql . "+";
                    break;

                case "-":
                    $sSql = $sSql . "-";
                    break;

                case "*":
                    $sSql = $sSql . "*";
                    break;

                case "/":
                    $sSql = $sSql . "/";
                    break;

                case "contar(":
                    $sSql = $sSql . "count(";
                    $sSqlGroupT=true;
                    break;

                case ")":
                    $sSql = $sSql . ")";
                    break;

                case "(":
                    $sSql = $sSql . "(";
                    break;

                default:
                    $tmp =  explode(".", $valor);
                    if(sizeof($tmp)==2)
                    {
                        if($sSqlGroupT)
                        {
                            $sSqlGroup.=$tmp[0].".".$tmp[1];
                            $sSqlGroupT=false;
                        }

                        if(array_search($tmp[0],$tablas)==false)
                        {
                            array_push($tablas,array_search($tmp[0],$tablas));
                            array_push($tablas,$tmp[0]);

                            //$sSqlFrom = $sSqlFrom . $tmp[0] . ",";
                        }
                        $sSql = $sSql . $tmp[0] . "." . $tmp[1];
                    }
                    else
                        return var_dump($tmp);
            }
        }

        $nTablas = sizeof($tablas);
        $preFrom = array();
        $preWhere = array();
        if($nTablas > 2){
            for($i=3; $i<$nTablas; $i=$i+2){
                //La tabla esta dentro del contenedor anterior al from?
                if(!in_array($tablas[$i],$preFrom)){
                    //Si no lo esta buscamos el camino entre la anterior tabla, que debe estar en el contenedor y la actual
                    $caminos = $this->camino($tablas[$i-2], $tablas[$i]);

                    //Cada tabla del camino se revisa si esta incluida en el contenedor anteior al from
                    //y si no lo esta entonces se incluye al mismo
                    foreach($caminos['from'] as $tabla) {
                        if (!in_array($tabla, $preFrom)) {
                            array_push($preFrom, $tabla);
                        }
                    }

                    //Cada conexion entre tablas se revisa si esta incluida en el contenedor anteior al where
                    //y si no lo esta entonces se incluye al mismo
                    foreach($caminos['where'] as $conexion) {
                        if(!in_array($conexion, $preWhere)){
                            array_push($preWhere, $conexion);
                        }
                    }
                }
            }
        }

        //Se vuelca el contenido del contenedor anterior al from a la sentencia From
        foreach($preFrom as $tabla){
            $sSqlFrom = $sSqlFrom . $tabla . ",";
        }

        //Se vuelca el contenido del contenedor anterior al where a la sentencia Where
        foreach($preWhere as $conexion){
            $sSqlWhere = $sSqlWhere . $conexion . " AND ";
        }

        $sSqlFrom = substr($sSqlFrom,0,strlen($sSqlFrom)-1);
        $sSqlWhere = substr($sSqlWhere,0,strlen($sSqlWhere)-5);
        $sSqlDef  = $sSql.$sSqlFrom.$sSqlWhere;
        if($sSqlGroup != "")
            $sSqlDef.=" GROUP BY (".session('base').".".$sSqlGroup;

        $tablas = DB::select($sSqlDef);

        return $sSqlDef;
        //return view('generacionIndicadores/tabla')->with('tablas', $tablas);
    }

    public function evaluarConsulta(Request $request){
        $this->inicial();
        $tablas = DB::select($request['consulta']);
        return view('generacionIndicadores/tabla')->with('tablas', $tablas);
    }

    public function elegirBd(){
        $this->inicial();
        $bases=DB::select('SHOW DATABASES');
        return view('generacionIndicadores/elegir')->with("bases",$bases);
    }

    public function setBd(Request $r){
        session(['base' => $r['datos']]);
        $ret = $this->matrizCaminos();
        $relaciones = $ret[0];
        $grafoTablas = $ret[1];
        session(['grafoTablas' => $grafoTablas]);
        session(['relaciones' => $relaciones]);
        return redirect()->action('GeneracionIndicadores@index');
    }

    public function setEnvironmentValue($envKey, $envValue)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $oldValue = strtok($str, "{$envKey}=");

        $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}\n", $str);

        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
    }


}
