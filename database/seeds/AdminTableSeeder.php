<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@DiyaHandicraft.com',
            'password' => bcrypt('password'),
            'address' => 'Kapan, Ektabasti',
            'phone' => '986*******',
            'is_admin' => 1,
        ]);
    }
}
