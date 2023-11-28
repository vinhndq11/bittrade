<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 15)->nullable();
            $table->text('password')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender')->default(GENDER_UNKNOWN);
            $table->unsignedTinyInteger('is_active')->default(1);
            $table->unsignedTinyInteger('is_admin')->default(0);
            $table->softDeletes();
            $table->string('remember_token', 255)->nullable();
            $table->text('reset_token')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
