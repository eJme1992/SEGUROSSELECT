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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// EXPORTAR Y IMPORTAR MARCAS DE AUTOS RUTAS
Route::get('marcas-list-excel', 'MarcaController@exportExcel')->name('marcas.excel');
Route::get('marcas-reiniciar', 'MarcaController@Reiniciar')->name('marcas.Reiniciar');
Route::post('import-list-excel-marca', 'MarcaController@importExcel')->name('marcas.import.excel');
// RUTAS API MARCA
Route::get('getmarcas', 'MarcaController@GetMarcas');

// EXPORTAR Y IMPORTAR MODELOS DE AUTOS RUTAS
Route::get('modelo-list-excel', 'ModeloController@exportExcel')->name('modelo.excel');
Route::get('modelos-reiniciar', 'ModeloController@Reiniciar')->name('modelos.Reiniciar');
Route::post('import-list-excel-modelo', 'ModeloController@importExcel')->name('modelo.import.excel');
// RUTAS API MODELOS
Route::get('getmodelos/{code}', 'ModeloController@GetModelos');

// EXPORTAR Y IMPORTAR AUTOS Y AÑOS RUTAS
Route::get('autos-list-excel', 'AutoController@exportExcel')->name('autos.excel');
Route::get('autos-reiniciar', 'AutoController@Reiniciar')->name('autos.Reiniciar');
Route::post('import-list-excel-auto', 'AutoController@importExcel')->name('autos.import.excel');
// RUTAS API AUTOS
Route::get('getautos/{code}/{code_marca}', 'AutoController@GetAutos');
Route::get('getestados/{ano}/{code_marca}/{code_modelo}', 'AutoController@GetEstados');
// RUTAS API PROVINCIAS
Route::get('getprovincia', 'ProvinciaController@GetProvincia');
Route::get('getciudades/{code}', 'CityController@GetCiudades');

Route::get('apiprueba', 'RequestController@GetConfiguration');
