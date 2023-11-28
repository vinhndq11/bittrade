<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommissionColumnToMemberTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_transactions', function (Blueprint $table) {
            $table->unsignedInteger('commission_member_id')->index('mt_commission_member_id_index')->nullable();
            $table->unsignedInteger('commission_transaction_id')->index('mt_commission_transaction_id_index')->nullable();
            $table->double('commission_percent')->nullable();
            $table->string('commission_type')->nullable();
            $table->unsignedTinyInteger('commission_level')->nullable()->comment('Cấp độ hoa hồng được hưởng');
            $table->foreign('commission_member_id', 'mt_commission_member_id_foreign')->references('id')->on('members')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('commission_transaction_id', 'mt_commission_transaction_id_foreign')->references('id')->on('member_transactions')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member_transactions', function (Blueprint $table) {
            //
        });
    }
}
