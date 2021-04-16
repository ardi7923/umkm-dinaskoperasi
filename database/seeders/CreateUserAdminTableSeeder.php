<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'	=> 'admin',
            'username'	=> 'admin',
            'password'	=> bcrypt('123456'),
            'role' => 'ADMIN'
    ]);
    }
}
