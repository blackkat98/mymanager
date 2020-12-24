<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('111111'),
            'email' => 'admin@gmail.com',
            'phone' => '0999999999',
            'address' => '',
        ]);

        DB::table('users')->insert([
            'first_name' => 'Nam',
            'middle_name' => 'Hoang',
            'last_name' => 'Tong',
            'username' => 'admin',
            'password' => Hash::make('111111'),
            'email' => 'nam.th.200698@gmail.com',
            'phone' => '0999999999',
            'address' => '',
        ]);
    }
}
