<?php


namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class DbHelper
{
    public static function truncateTable($tables = [])
    {
        foreach ($tables as $table){
            DB::table($table)->delete();
        }
        DB::statement("SET foreign_key_checks=0");
        foreach ($tables as $table){
            DB::table($table)->truncate();
        }
        DB::statement("SET foreign_key_checks=1");
    }
}
