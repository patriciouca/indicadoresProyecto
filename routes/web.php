<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*Route::post('/generacionGrafica', function () {
    return view('generacionGrafica/welcome');
});*/

Route::get('/generacionIndicador', 'GeneracionIndicadores@elegirBd');

Route::get('/generacionIndicador/elegir', 'GeneracionIndicadores@index');

Route::post('/generacionGrafica','Graficas@load');

Route::post('/generacionIndicador/setBd','GeneracionIndicadores@setBd');

Route::post('/generacionIndicador/getConsulta','GeneracionIndicadores@generateSql');

Route::post('/generacionIndicador/getConsulta2','GeneracionIndicadores@realizarConsultaSQL');

Route::post('/generacionIndicador/evaluarConsulta','GeneracionIndicadores@evaluarConsulta');

Route::get('/generacionIndicador/getCampos/{nombre}', 'GeneracionIndicadores@getCampos');

Route::get('/generacionIndicador/getRelaciones', 'GeneracionIndicadores@getRelaciones');

Route::get('/generacionIndicador/camino/{nombre}/{nombre2}', 'GeneracionIndicadores@camino');
