<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->string('two_fa')->nullable();
            $table->string('identity_number')->nullable();
            $table->string('before_identity_card')->nullable();
            $table->string('after_identity_card')->nullable();
            $table->unsignedTinyInteger('is_active')->default(1);
            $table->unsignedTinyInteger('is_verify')->default(0);
            $table->unsignedTinyInteger('is_two_fa')->default(0);
            $table->unsignedTinyInteger('enable_sound')->default(1);
            $table->unsignedTinyInteger('is_show_balance')->default(1);
            $table->string('otp')->nullable();
            $table->text('password')->nullable();
            $table->text('note')->nullable();
            $table->text('reset_token')->nullable();
            $table->dateTime('last_login')->nullable()->comment('Thời gian đăng nhập cuối cùng');
            $table->unsignedTinyInteger('email_notification')->nullable()->default(1)->comment('Nhận email thông báo');
            $table->string('current_point_type', 20)->default(POINT_TYPE_DEMO)->comment('Loại tiền sử dụng hiện tại');
            $table->softDeletes();
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
        Schema::dropIfExists('members');
    }
}
