<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateColorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('colors', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('remote_id', 50);
			$table->string('rgb', 50);
			$table->string('code', 50);
			$table->string('title');
			$table->string('type', 50);
			$table->integer('price');
			$table->string('swatch', 50);
			$table->string('image', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('colors');
	}

}
