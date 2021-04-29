<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'sanjog karki',
            'email' => 'sanjog.karki1460@gmail.com',
            'password' => bcrypt('password'),
            'address' => 'gothatar,kathmandu',
            'phone' => '9860413597',
            'gender'=>'male'
        ]);
    }
}
