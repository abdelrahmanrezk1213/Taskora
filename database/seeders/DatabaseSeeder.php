<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory()->count(5)->create();

        $categories = Category::factory()->count(10)->create();

        foreach ($users as $user) {
            Task::factory()
                ->count(10)
                ->create([
                    'user_id' => $user->id,
                    'category_id' => $categories->random()->id,
                ]);
        }

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
