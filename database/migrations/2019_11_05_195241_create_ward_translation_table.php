<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWardTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ward_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ward_id');
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->string('prefix')->nullable();
            $table->unique(['ward_id','locale']);
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ward_translations');
    }
}
