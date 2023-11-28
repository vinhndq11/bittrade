<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHackerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hackers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->unsignedTinyInteger('is_active')->default(1);
            $table->unsignedTinyInteger('is_verify')->default(0);
            $table->text('password')->nullable();
            $table->text('note')->nullable();
            $table->text('reset_token')->nullable();
            $table->dateTime('last_login')->nullable()->comment('Thời gian đăng nhập cuối cùng');
            $table->unsignedInteger('trial_count')->default(0);
            $table->dateTime('expired_tool_at')->default(now())->nullable();
            $table->unsignedTinyInteger('is_active_tool')->default(1);
            $table->string('user_mode', 10)->default(USER_MODE_TRAIL);
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
        Schema::dropIfExists('hackers');
    }
}
