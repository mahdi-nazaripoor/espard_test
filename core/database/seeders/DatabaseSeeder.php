<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        //Create a test admin user
         User::create([
             'name' => 'Test Admin User',
             'mobile' => '09121111111',
             'email' => 'admin@example.com',
             'is_admin' => '1',
             'password' => Hash::make('09121111111')
         ]);

        //Create a test user
        User::create([
            'name' => 'Test User',
            'mobile' => '09122222222',
            'email' => 'test@example.com',
            'password' => Hash::make('09122222222')
        ]);

        //To make demo items of products table
        DB::unprepared("INSERT INTO `products` (`id`, `title`, `uid`, `price`, `main_pic`, `description`, `created_at`, `updated_at`) VALUES
(1, 'AMG Mercedes C63', '6HBClAZMPBBBRqCn', 98000, 'e10adc3949ba59abbe56e057f20f883e.jpg', 'AMG Mercedes C63 description content', '2023-04-25 06:34:24', '2023-04-25 06:42:19'),
(2, 'Samsung Galaxy S22 Angle', 'WmsHMnNJ9IcF1l8z', 500, 'e10adc3949ba59abbe56e057f20f883e.jpg', 'Samsung Galaxy S22 Angle description content', '2023-04-25 06:34:24', '2023-04-25 06:42:19'),
(3, 'iPhone 14 Pro Max', 'R5czB0uU40nP8TuQ', 1500, 'e10adc3949ba59abbe56e057f20f883e.jpg', 'iPhone 14 Pro Max description content', '2023-04-25 06:34:24', '2023-04-25 06:42:19'),
(4, 'Macbook Pro M2', 'RHJ0xumx1RndZEKY', 2000, 'e10adc3949ba59abbe56e057f20f883e.jpg', 'Macbook Pro M2 description content', '2023-04-25 06:34:24', '2023-04-25 06:42:19'),
(5, 'Renault Koleos 2021', 'tIJGCpsZTQbhfzvS', 2000, 'e10adc3949ba59abbe56e057f20f883e.jpg', 'Renault Koleos 2021 description content', '2023-04-25 06:34:24', '2023-04-25 06:42:19');");
    }
}
