<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionWithdrawalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_withdrawals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payment_type');
            $table->string('bank_name')->nullable();
            $table->string('bank_number')->nullable()->comment('Số tài khoản/MOMO');
            $table->string('bank_account')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('expired_date', 10)->nullable()->comment('Ngày hết hạn visa/master');
            $table->string('cvv', 10)->nullable()->comment('Số cvv/cvc/ccv');
            $table->unsignedInteger('transaction_id')->index();
            $table->foreign('transaction_id')->references('id')->on('member_transactions')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_withdrawals');
    }
}
