<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpenCloseColumnToMemberTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_transactions', function (Blueprint $table) {
            $table->float('open_price')->nullable();
            $table->float('close_price')->nullable();
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
            $table->dropColumn(['open_price', 'close_price']);
        });
    }
}
