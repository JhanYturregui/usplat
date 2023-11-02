<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clientes', [
    'uses' => 'ClienteController@index',
    'as'   => 'clientes'
]);
Route::get('/clientes/obtener', [
    'uses' => 'ClienteController@obtenerDatos',
    'as'   => 'clientes_obtener'
]);
Route::get('/clientes/crear', [
  'uses' => 'ClienteController@create',
  'as'   => 'clientes_crear'
]);
Route::post('/clientes/registrar', [
  'uses' => 'ClienteController@store',
  'as'   => 'clientes_registrar'
]);
Route::get('/clientes/editar/{id}', [
  'uses' => 'ClienteController@show',
  'as'   => 'clientes_editar'
]);
Route::post('/clientes/actualizar', [
  'uses' => 'ClienteController@update',
  'as'   => 'clientes_actualizar'
]);
Route::post('/clientes/eliminar', [
  'uses' => 'ClienteController@delete',
  'as'   => 'clientes_eliminar'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
