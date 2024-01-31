<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Package;
use App\Models\Product;
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

        // User Default First
        User::create([
            'name' => 'ClaryLand Playground',
            'email' => 'info@clarylandplayground.com',
            'username' => 'claryland',
            'contact' => '081222014448',
            'password' => bcrypt('090906'), // Default "090906"
            'access_type' => 1,
            'active' => 1,
        ]);

        // Category Default First
        Category::create([
            'name' => 'Tiket',
            'description' => 'Tiket Bermain dan Pendamping / Tambahan'
        ]);

        // Product Default
        Product::create([
            'name' => 'Ticket Bermain',
            'price' => 100000,
            'category_id' => 1,
        ]);
        Product::create([
            'name' => 'Ticket Pendamping',
            'price' => 0,
            'category_id' => 1,
        ]);
        Product::create([
            'name' => 'Ticket Pendamping (Tambahan)',
            'price' => 20000,
            'category_id' => 1,
        ]);

        // Package Default
        Package::create([
            'name' => 'Regular or Weekdays',
            'price' => 50000,
            'Description' => 'Harga tiket berlaku untuk Senin s/d Jumat selain hari libur nasional',
        ]);
        Package::create([
            'name' => 'Weekend and Holiday',
            'price' => 60000,
            'Description' => 'Harga tiket berlaku untuk sabtu s/d minggu dan hari libur nasional',
        ]);
    }
}
