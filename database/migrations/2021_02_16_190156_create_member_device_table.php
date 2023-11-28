<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberDeviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id')->index();
            $table->text('fcm_token')->nullable();
            $table->string('device_type')->default(DEVICE_WEB)->nullable()->comment('Loại thiết bị đăng nhập');
            $table->text('login_token')->nullable();
            $table->timestamps();
            $table->foreign('member_id')->references('id')->on('members')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_devices');
    }
}
