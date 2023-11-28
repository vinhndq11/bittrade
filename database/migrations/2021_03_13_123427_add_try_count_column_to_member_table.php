<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTryCountColumnToMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->unsignedInteger('trial_count')->default(0);
            $table->dateTime('expired_tool_at')->default(now())->nullable();
            $table->unsignedTinyInteger('is_active_tool')->default(1);
            $table->string('user_mode', 10)->default(USER_MODE_TRAIL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['trial_count', 'expired_tool_at', 'is_active_tool', 'user_mode']);
        });
    }
}
