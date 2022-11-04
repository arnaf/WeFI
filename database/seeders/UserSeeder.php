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

        $user1 = User::create([
            'email' => 'dimas@mail.com',
            'password' => bcrypt('member123'),
            'nama'  => 'Dimas Nugraha',
            'tgl_lhr' => '2000-04-19',
            'tmp_lhr'  => 'Sukabumi',
            'pendidikan' => 'Kuliah',
            'alamat' => 'Jl. Sukadamai No 12'
        ]);
        $user1 -> assignRole('member');

        $user2 = User::create([
            'email' => 'ayu@mail.com',
            'password' => bcrypt('member123'),
            'nama'  => 'Ayu Puspitasari',
            'tgl_lhr' => '2002-11-28',
            'tmp_lhr'  => 'Majalengka',
            'pendidikan' => 'Kuliah',
            'alamat' => 'Perum Maju Jaya Blok A1'
        ]);
        $user2 -> assignRole('member');

        $user3 = User::create([
            'email' => 'farhan@mail.com',
            'password' => bcrypt('member123'),
            'nama'  => 'Farhan Prasetya',
            'tgl_lhr' => '2001-12-12',
            'tmp_lhr'  => 'Jakarta',
            'pendidikan' => 'Kuliah',
            'alamat' => 'Jl. Pisangan Lama No, 14'
        ]);
        $user3 -> assignRole('member');

        $user4 = User::create([
            'email' => 'lita@mail.com',
            'password' => bcrypt('member123'),
            'nama'  => 'Lita Anjani',
            'tgl_lhr' => '2004-06-05',
            'tmp_lhr'  => 'Depok',
            'pendidikan' => 'SMA',
            'alamat' => 'Gg. Sukahati'
        ]);
        $user4 -> assignRole('member');

    }
}
