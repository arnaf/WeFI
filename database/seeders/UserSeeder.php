<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin123'),
        ]);
        $admin -> assignRole('admin');

        $user = User::create([
            'email' => 'member@mail.com',
            'password' => bcrypt('member123'),
        ]);
        $user -> assignRole('member');

    }
}
