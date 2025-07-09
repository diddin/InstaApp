<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 10 user masing-masing dengan 3 post
        User::factory()
            ->count(10)
            ->hasPosts(3)
            ->create();
    }
}
