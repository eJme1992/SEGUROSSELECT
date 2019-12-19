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
			$table->string('año');
			$table->string('estado');
			$table->timestamps();

			$table->foreign('auto_id')->references('id')->on('autos');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('requests');
	}
}
