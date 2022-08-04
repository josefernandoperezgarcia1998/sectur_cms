<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'José Fernando',
            'email' => 'josefernandoperezgarcia98@gmail.com',
            'password' => bcrypt('123'),
            'rol' => 'Administrador',
            'estado' => 'Si',
        ]);
        
    }
}
