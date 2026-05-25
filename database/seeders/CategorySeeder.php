<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
	public function run(): void
	{
        $categories = [
            ['id' => 1, 'name' => 'Entertainment'],
            ['id' => 2, 'name' => 'Productivity'],
            ['id' => 3, 'name' => 'Developer Tools'],
            ['id' => 4, 'name' => 'Security'],
            ['id' => 5, 'name' => 'Education'],
            ['id' => 6, 'name' => 'Health'],
            ['id' => 7, 'name' => 'News'],
            ['id' => 8, 'name' => 'Finance'],
            ['id' => 9, 'name' => 'Gaming'],
        ];

        Category::query()->upsert($categories, ['id'], ['name']);
	}
}
