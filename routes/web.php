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

Route::get('/generacionGrafica', function () {
    return view('generacionGrafica/welcome');
});

Route::get('/generacionIndicador', 'GeneracionIndicadores@index');
Route::post('/generacionIndicador/getConsulta','GeneracionIndicadores@generateSql');
Route::post('/generacionIndicador/getConsulta2','GeneracionIndicadores@generateSql2');
Route::post('/generacionIndicador/evaluarConsulta','GeneracionIndicadores@evaluarConsulta');

Route::get('/generacionIndicador/getCampos/{nombre}', 'GeneracionIndicadores@getCampos');
Route::get('/generacionIndicador/getRelaciones', 'GeneracionIndicadores@getRelaciones');
