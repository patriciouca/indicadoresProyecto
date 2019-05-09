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
        {
            $devolver[$contador][0] = head($tablas[$contador]);
            $devolver[$contador][1] = $this->getCampos($devolver[$contador][0]);
            $contador++;
        }
        return view('generacionIndicadores/welcome')->with('tablas', $devolver);
    }

    public function getCampos($nombre)
    {
        $tablas = DB::select('DESCRIBE '.$nombre);
        return $tablas;
    }

    public function getRelaciones()
    {
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

    public function generateSql(Request $request){

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
}
