<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReservationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reservations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('reservation_date');
			$table->integer('reservation_period');
			$table->integer('chalet_id');
			$table->integer('member_id');
			$table->integer('price');
			$table->boolean('is_active')->default(1);
			$table->timestamps();
			$table->enum('state', array('Done','Deleted','InProgress'))->default('InProgress');
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
		Schema::drop('reservations');
	}

}
