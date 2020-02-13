<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('requests', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('city_id')->unsigned();
			$table->string('seguro_id');
			$table->string('telefono');
			$table->string('interesado');
			$table->string('fecha_de_nacimiento');
			$table->string('ciudad');
			$table->string('seguro');
			$table->string('cotizacion');
			$table->string('estado');

			$table->timestamps();

			$table->foreign('city_id')->references('id')->on('cities');
		});
	}

	/**
	 * Reverse the migrations.
	 *s
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('requests');
	}
}
