<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFavoriteChaletsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('favorite_chalets', function(Blueprint $table)
		{
			$table->integer('chalet_id');
			$table->integer('member_id');
			$table->integer('id', true);
			$table->timestamps();
			$table->softDeletes();
			$table->unique(['chalet_id','member_id'], 'Unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('favorite_chalets');
	}

}
