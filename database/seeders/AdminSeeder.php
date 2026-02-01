<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role as ModelsRole;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = ['admin', 'it', 'user', 'manager'];
        foreach($roles as $role){
          ModelsRole::firstOrCreate(['name'=>$role]); // ini penting
        }

         User::firstOrCreate([
            'name' => 'Admin',
            'email' => 'admin@web.id',
            'password' => Hash::make('Admin123'),
            'status' => 'active',
        ])->assignRole('admin');

        User::firstOrCreate([
            'name' => 'IT Support',
            'email' => 'itdept@web.id',
            'password' => Hash::make('Itdept123'),
            'status' => 'active',
        ])->assignRole('it');

        User::firstOrCreate([
            'name' => 'person1',
            'email' => 'user@web.id',
            'password' => Hash::make('User123'),
            'status' => 'active',
        ])->assignRole('user');

        User::firstOrCreate([
            'name' => 'Joko Ardiyanto,S.Kom',
            'email' => 'manager@web.id',
            'password' => Hash::make('managerIT'),
            'status' => 'active',
        ])->assignRole('manager');
    }
}
