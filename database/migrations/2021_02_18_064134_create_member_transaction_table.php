<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 50);
            $table->string('point_type', 20)->default(POINT_TYPE_DEMO)->comment('Loại tiền sử dụng');
            $table->string('transaction_type', 20)->default(TRANSACTION_TYPE_BET)->comment('Loại giao dịch');
            $table->string('transaction_status', 30)->default(TRANSACTION_STATUS_PENDING)->comment('Trạng thái giao dịch');
            $table->double('value')->default(0);
            $table->string('bet_condition')->nullable()->comment('Đặt cược tăng hay giảm');
            $table->double('bet_value')->default(0)->comment('Giá trị đặt cược');
            $table->string('bet_id')->nullable()->comment('ID của ván cược, createDatetime');
            $table->string('note', 500)->nullable()->comment('Ghi chú thêm');
            $table->timestamps();
            $table->unsignedInteger('member_id')->index();
            $table->unique(['code', 'transaction_type', 'point_type'], 'member_transactions_ctt_unique');
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
        Schema::dropIfExists('member_transactions');
    }
}
