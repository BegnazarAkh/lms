<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::create([
            'name'     => 'Alice Teacher',
            'email'    => 'alice.teacher@example.com',
            'password' => Hash::make('password123'),
            'role'     => 'teacher',
        ]);
    
        User::create([
            'name'     => 'Bob Teacher',
            'email'    => 'bob.teacher@example.com',
            'password' => Hash::make('secure456'),
            'role'     => 'teacher',
        ]);

        $this->call(LmsSeeder::class);

    }
}
