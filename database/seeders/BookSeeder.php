<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    private const COUNT = 100;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = new 
        for ($index = 0; $index < self::COUNT; $index++) {
            Book::create([
                'title' => fake()->sentence(3),
                'author' => fake()->name(),
                'genre' => fake()->word(),
            ]);
        }
    }
}
