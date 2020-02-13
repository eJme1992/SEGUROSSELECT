<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutosTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('autos', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('id_vehiculo');
			$table->string('name');
			$table->string('code_vehiculo');
			$table->string('code_marca');
			$table->string('code_modelo');		
			$table->string('cerokm');
			$table->timestamps();

	



		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('autos');
	}
}
