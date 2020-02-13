<?php

namespace App\Http\Controllers;
use App\Auto;
use App\Estado;
use App\Imports\AutosImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AutoController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
	}

	public function GetAutos($code, $code_marca) {
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Allow: GET, POST, OPTIONS, PUT, DELETE");

		$Auto = Auto::where('code_modelo', $code)->where('code_marca', $code_marca)->get();
		$estado = 0;
		//VERIFICO QUE EL MODELO TENGA AL MENOS UN AÑO ACTIVO
		foreach ($Auto AS $row) {

			$R = Estado::where('auto_id', $row->id)->where('estado', 1)->get();

			if ($R != NULL) {
				foreach ($R AS $row2) {

					$ARRAY[] = $row2->año;
					$estado = 1;
				}
			}
		}

		if ($estado != 0) {

			$lista_simple = array_values(array_unique($ARRAY));
			sort($lista_simple);
			//$lista_simple = var_export($lista_simple);
			return response()->json(['datos' => $lista_simple, 'status ' => 'ok'], 200);
		} else {

			return response()->json([

				'datos' => "Actualmente no hay seguros para este Modelo",
				'status' => 0,
			], 200);
		}

	}

	public function GetEstados($ano, $code_marca, $code_modelo) {

		header('Access-Control-Allow-Origin: *');

		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");

		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

		header("Allow: GET, POST, OPTIONS, PUT, DELETE");

		$Auto = Auto::join('estados', 'estados.auto_id', '=', 'autos.id')
			->where('autos.code_modelo', $code_modelo)
			->where('autos.code_marca', $code_marca)
			->where('estados.estado', 1)
			->where('estados.año', $ano)->get();

		return response()->json([

			'datos' => $Auto,
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
			'año_i' => 'required',
			'año_c' => 'required',
		]);

		$file = $request->file('file');

		if ($file->extension() == 'xlsx') {
			$inicio = $request->input('año_i');
			$cierre = $request->input('año_c');
			$array = Excel::toArray(new AutosImport, $file);

			//RECORRO EL ARRAY DE AUTOS
			foreach ($array[0] as $row) {

				$auto = new auto();
				$idverificador = Auto::where('id', $row[0])->first();

				if ($idverificador == NULL) {
					$auto->id = $row[0];
					$auto->id_vehiculo = $row[1];
					$auto->name = $row[2];
					$auto->code_vehiculo = $row[3];
					$auto->code_marca = $row[4];
					$auto->code_modelo = $row[5];
					$auto->cerokm = $row[6];

					$auto->save();

					//Guardo el estado del auto en su tabla para esto recorro el array por cada año
					$i = 7;
					for ($x = $cierre; $x >= $inicio; $x--) {
						$año = $x;
						$estado = new Estado();
						$estado->auto_id = $auto->id;
						$estado->año = $año;
						if (isset($row[$i])) {
							$estado->estado = $row[$i];
						} else {
							$estado->estado = NULL;
						}
						$estado->save();
						$i++;
					}
				}
			}

			return back()->with('message1', 'Importanción de usuarios completada');
		} else {
			return back()->with('message1', 'La extinción del archivo debe ser XLSX');
		}
	}

	public function Reiniciar() {

		DB::insert("SET FOREIGN_KEY_CHECKS=0;");
		DB::insert("TRUNCATE TABLE estados");
		DB::insert("SET FOREIGN_KEY_CHECKS=1;");
		//
		DB::insert("SET FOREIGN_KEY_CHECKS=0;");
		DB::insert("TRUNCATE TABLE autos");
		DB::insert("SET FOREIGN_KEY_CHECKS=1;");

		//DB::table('autos')->truncate();

		return back()->with('message1', 'La extencion del archivo debe ser XLSX');
	}

}
