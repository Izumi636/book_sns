<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{

    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Art & Music'],
            ['name' => 'Biographies'],
            ['name' => 'Business'],
            ['name' => 'Comics'],
            ['name' => 'Education'],
            ['name' => 'Entertainment'],
            ['name' => 'Health'],
            ['name' => 'Craft & Home'],
            ['name' => 'History'],
            ['name' => 'Horror'],
            ['name' => 'Kids'],
            ['name' => 'Literature'],
            ['name' => 'Medical'],
            ['name' => 'Mysteries'],
            ['name' => 'Romance'],
            ['name' => 'Sci-Fi'],
            ['name' => 'Fantasy'],
            ['name' => 'Travel'],
            ['name' => 'Sports'],
            ['name' => 'Others']
        ];

        $this->category->insert($categories);
    }
}
