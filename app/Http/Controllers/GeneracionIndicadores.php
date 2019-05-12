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

    public function matrizCaminos($tabla1,$tabla2){

        $relaciones = array();
        $caminos = array();
        $arrayAux = $this->getRelaciones();

        //Generacion de un Array que almacene todas las relaciones en un formato mas comodo para trabajar
        foreach ($arrayAux as $relacionSinProcesar) {
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

        $arrayAux = $this->getTablasCampos();

        //Convertir $arrayAux en un array con el cual sea mas facil trabajar
        for ($i = 0; $i < count($arrayAux); $i++) {
            $arrayAux[$i] = $arrayAux[$i][0];
        }

        foreach ($arrayAux as $tabla1) {
            $caminos[$tabla1] = array();
            foreach ($arrayAux as $tabla2) {
                $caminos[$tabla1][$tabla2] = "";
            }
        }

        //Guardando relaciones directas entre tablas
        foreach ($relaciones as $r) {
            $caminos[$r["tabla1"]][$r["tabla2"]] = $r["tabla2"];
            $caminos[$r["tabla2"]][$r["tabla1"]] = $r["tabla1"];

        }

        //Guardando caminos reflexivos triviales
        foreach ($arrayAux as $tabla) {
            $caminos[$tabla][$tabla] = $tabla;
        }

        //Guardando conexion entre las distintas tablas
        foreach ($arrayAux as $tabla3) {
            foreach ($arrayAux as $tabla1) {
                foreach ($arrayAux as $tabla2) {
                    if ($caminos[$tabla1][$tabla2] == "") {
                        if ($caminos[$tabla1][$tabla3] != "" && $caminos[$tabla3][$tabla2] != "") {
                            $caminos[$tabla1][$tabla2] = $tabla3;
                        }
                    }
                }
            }
        }

        //$devolver=array($relaciones, $caminos);
        return $this->camino($relaciones,$caminos,$tabla1,$tabla2);
    }

    function encontrarRelacion($relaciones, $tabla1, $tabla2){
        foreach ($relaciones as $r){
            if(($r["tabla1"]==$tabla1 && $r["tabla2"]==$tabla2) || ($r["tabla2"]==$tabla1 && $r["tabla1"]==$tabla2))
                return $r;
        }
        return null;
    }

    public function camino(&$relaciones, &$grafoTablas, $tabla1, $tabla2){
        $tablaActual = $tabla2;
        $from = array();
        $where = array();
        $cont = 0;
        //Guarda en el array $from todas las tablas involucradas en el camino, empezsando por tabla2 y acabando en tabla 1
        while($tablaActual != $grafoTablas[$tabla1][$tablaActual]){
            $from[$cont] = $tablaActual;
            $tablaActual = $grafoTablas[$tabla1][$tablaActual];
            $cont++;
        }
        $from[$cont++] = $tablaActual;
        $from[$cont] = $tabla1;


        //Generacion de las distintas clausulas where para unir las tablas
        for($i=0; $i<$cont; $i++){
            $r = $this->encontrarRelacion($relaciones, $from[$i], $from[$i+1]);
            $where[$i] = $r["tabla1"] . "." . $r["elemento1"] . "=" . $r["tabla2"] . "." . $r["elemento2"];
        }

        return array("from" => $from, "where" => $where);
    }

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

        return view('generacionIndicadores/tabla')->with('tablas', $tablas);
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
