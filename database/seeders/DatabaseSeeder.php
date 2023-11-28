<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'name' => 'ClaryLand',
            'email' => 'claryland@example.com',
            'username' => 'claryland',
            'contact' => '081234567890',
            'password' => bcrypt('090906'), // Default "090906"
            'access_type' => 1,
            'active' => 1,
        ]);
    }
}
