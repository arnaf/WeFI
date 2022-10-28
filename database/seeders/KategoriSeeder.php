<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $k1 = Kategori::create([
            'nama' => 'Programming',
        ]);

        $k2 = Kategori::create([
            'nama' => 'Cooking',
        ]);

        $k3 = Kategori::create([
            'nama' => 'Subjects',
        ]);

        $k4 = Kategori::create([
            'nama' => 'Engineering',
        ]);

        $k5 = Kategori::create([
            'nama' => 'Surviving',
        ]);
    }
}
