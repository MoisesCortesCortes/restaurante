<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'camarero',
             'email' => 'camarero@rest.com',
             'password'=>Hash::make('12345678'),
             'role'=> 'camarero'
         ]);
         \App\Models\User::factory()->create([
            'name' => 'cocinero',
            'email' => 'cocinero@rest.com',
            'password'=>Hash::make('12345678'),
            'role'=> 'cocinero'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'administrador',
            'email' => 'admin@rest.com',
            'password'=>Hash::make('12345678'),
            'role'=> 'admin'
        ]);
    }
}
