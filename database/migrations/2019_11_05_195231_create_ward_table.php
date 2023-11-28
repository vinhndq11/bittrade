<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateWardsTable.
 */
class CreateWardTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wards', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('district_id');
            $table->integer('position')->default(0);
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wards');
	}
}
