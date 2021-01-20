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
        $user = \App\User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin',
            'phone' => '010',
            'role' => 'admin',
            'password' => bcrypt('1230012300')
        ]);
    }
}
