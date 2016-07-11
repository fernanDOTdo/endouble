<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Fernando Santos',
            'email' => 'fern@ndo.io',
            'password' => '$2y$10$YpHQi3P0aGHAfqKd6HK6Q.IOKziHf/xsRU4tHdCbx8R7Df6GClxrG',
        ]);
    }
}
