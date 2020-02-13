<?php

namespace App\Http\Controllers;

use App\Imports\MarcasImport;
use App\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MarcaController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function GetMarcas() {

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Allow: GET, POST, OPTIONS, PUT, DELETE");
		$Marca = Marca::orderBy('name')->get();
		return response()->json([
			'datos' => $Marca,
			'status' => 'ok',
		], 200);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}

	public function importExcel(Request $request) {

		set_time_limit(5000);

		$validatedData = $request->validate([
			'file' => 'required',
		]);
		$file = $request->file('file');

		if ($file->extension() == 'xlsx') {
			Excel::import(new MarcasImport, $file);
			return back()->with('message3', 'Importanción de Marcas completada');
		} else {
			return back()->with('message2', 'La extinción del archivo debe ser XLSX');
		}

	}

	public function Reiniciar() {
		DB::table('Marcas')->truncate();
		return back()->with('message3', 'La base de datos a sido reiniciada');

	}

}
