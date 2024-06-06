<?php

namespace Database\Seeders;

use App\Models\Task;
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
        // Create 10 users
        User::factory(5)->create()->each(function ($user) {
            // For each user, create 5 tasks
            Task::factory(2)->create(['created_by' => $user->id]);
        });
    }
}