<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     

        $user = User::create([
            'name'  => 'guru',
            'email'     => 'guru@gmail.com',
            'password'  => bcrypt('guru12345'),
        ]);

        $role           = Role::where('name', 'guru')->first();
        $permissions    = Permission::pluck('id','id')->all();

        // $role->givePermissionTo([$permissions]);
        $user->assignRole([$role->id]);


        $user = User::create([
            'name'  => 'siswa',
            'email'     => 'siswa@gmail.com',
            'password'  => bcrypt('siswa12345'),
        ]);

        $role           = Role::where('name', 'siswa')->first();
        $permissions    = Permission::pluck('id','id')->all();

        // $role->givePermissionTo([$permissions]);
        $user->assignRole([$role->id]);
    }
}

