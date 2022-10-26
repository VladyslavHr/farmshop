<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        \App\Models\User::factory()->create([
            'name' => 'Vlad',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$YCsO7G2vJnPJ2YjGfvNF6OBzvza0L.duPRMbwuci4K64O/myLhQfm'
        ]);
    }
}
