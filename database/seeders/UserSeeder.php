<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a user
        $user = new \App\Models\User();
        $user->name = 'John Doe';
        $user->email = 'john@gmail.com';
        $user->password = \Illuminate\Support\Facades\Hash::make('password');
        $user->save();

        // Create a role
        $role = Role::create(['name' => 'admin']);

        //assign role to user
        $user->assignRole($role);

        // create customer user
        $customer = new \App\Models\User();
        $customer->name = 'Jane Doe';
        $customer->email = 'customer@gmail.com';
        $customer->password = \Illuminate\Support\Facades\Hash::make('password');
        $customer->save();

        // Create a role
        $role = Role::create(['name' => 'customer']);

        //assign role to user
        $customer->assignRole($role);
        
    }
}
