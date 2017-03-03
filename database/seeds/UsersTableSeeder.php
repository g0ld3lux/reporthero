<?php

use Illuminate\Database\Seeder;
use Reporthero\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@reporthero.io',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'password' => bcrypt('adminpass')
        ]);
    }
}
