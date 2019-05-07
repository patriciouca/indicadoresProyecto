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

    public function generateSql($sCampos){
       $sSql = "SELECT ";
       $sSqlFrom = "FROM";

       for($i = 0; $i<sizeof($sCampos);$i++){

           switch($sCampos){

               case "+":
                   $sSql = $sSql + "+";

               case "-":
                   $sSql = $sSql + "-";

               case "*":
                   $sSql = $sSql + "*";

               case "/":
                   $sSql = $sSql + "/";

               case "contar(":
                   $sSql = $sSql + "count(";

               case ")":
                   $sSql = $sSql + ")";

               default:

               $tmp = $sCampos[$i].str_split(".");
               $sSqlFrom = $sSqlFrom + $tmp[0] + ",";
               $sSql = $sSql + $tmp[1];

           }

       }
       $sSqlFrom = substr($sSqlFrom,sizeof($sSqlFrom)-1);
       $sSqlDef  = $sSql+$sSqlFrom;
    }
}
