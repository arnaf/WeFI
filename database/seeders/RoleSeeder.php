<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'tagihans',
        ]);


        Permission::create([
            'name' => 'datamt',
        ]);

        Permission::create([
            'name' => 'history',
        ]);

        Permission::create([
            'name' => 'daftar',
        ]);


        $admin->givePermissionTo('tagihans');
        $admin->givePermissionTo('datamt');
        $admin->givePermissionTo('history');
        $admin->givePermissionTo('daftar');

        $member = Role::create([
            'name' => 'member',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'tagihansaya',
        ]);

        Permission::create([
            'name' => 'myhistory',
        ]);


        $member->givePermissionTo('tagihansaya');
        $member->givePermissionTo('myhistory');

    }
}
