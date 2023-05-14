<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::updateOrCreate(
            [
                'email' => 'test@collectivebank.com'
            ],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'balance' => 0
            ]
        );
    }
}
