<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()
            ->count(5)
            ->create()->each(function ($user){
               $user->products()->create(\App\Models\Product::factory()->make()->toArray())
               ->categories()->attach([1, 2]);
            });
    }
}
