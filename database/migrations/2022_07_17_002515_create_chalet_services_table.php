<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChaletServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chalet_services', function(Blueprint $table)
		{
			$table->integer('service_id');
			$table->integer('chalet_id');
			$table->integer('id', true);
			$table->timestamps();
			$table->softDeletes();
			$table->unique(['chalet_id','service_id'], 'unique_index');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('chalet_services');
	}

}
