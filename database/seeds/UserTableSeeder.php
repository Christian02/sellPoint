<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        User::create([
        	'name'=>'jacob',
        	'email'=>'yeti0013@hotmail.com',
        	'password' =>bcrypt('jacob')
        	]);
    }
}
