<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChaletsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chalets', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('name', 65535);
			$table->text('phone', 65535);
			$table->integer('member_id');
			$table->text('address', 65535);
			$table->text('latitude', 65535);
			$table->text('longitude', 65535);
			$table->integer('price');
			$table->text('cover_image', 65535);
			$table->float('chalet_space', 10, 0);
			$table->integer('number_of_people_allowed');
			$table->integer('morning_period_start');
			$table->integer('morning_period_end');
			$table->integer('evening_period_start');
			$table->integer('evening_period_end');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('chalets');
	}

}
