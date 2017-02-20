<?php

use Illuminate\Database\Seeder;
use Laraspace\User;

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
            'name' => 'John Doe',
            'role' => 'admin',
            'password' => bcrypt('adminpass')
        ]);
    }
}
