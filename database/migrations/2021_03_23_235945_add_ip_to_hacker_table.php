
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIpToHackerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hackers', function (Blueprint $table) {
            $table->string('ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->unsignedInteger('allow_duplicate_ip')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hackers', function (Blueprint $table) {
            $table->dropColumn(['ip', 'user_agent', 'allow_duplicate_ip']);
        });
    }
}
