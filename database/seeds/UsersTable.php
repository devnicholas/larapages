<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123456'),
            'admin' => true,
        ]);
    }
}
