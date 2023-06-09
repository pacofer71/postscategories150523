<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
        
        User::factory(5)->create();
        $this->call(CategorySeeder::class);
        $this->call(TagSeeder::class);

        Storage::deleteDirectory('images');
        Storage::createDirectory('images');
        Post::factory(30)->create();
        
        $this->call(PostSeeder::class);
    }
}
