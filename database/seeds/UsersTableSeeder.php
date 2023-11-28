<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!User::exists()){
            $users = [
                ['name'=>'Admin', 'email'=>'admin@gmail.com','password'=>'123456', 'is_admin'=>1],
                ['name'=>'User', 'email'=>'user@gmail.com','password'=>'123456'],
            ];
            foreach ($users as $item)
            {
                User::create($item);
            }
        }
    }
}
