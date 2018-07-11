<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grades', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('car_id');
			$table->string('remote_id');
			$table->string('title');
			$table->string('engine_desc');
			$table->string('wheeldrive');
			$table->integer('price');
			$table->integer('pricediscount');
			$table->string('engine');
			$table->string('transmission');
			$table->string('body');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('grades');
	}

}
