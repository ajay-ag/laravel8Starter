<?php

namespace Database\Seeders;
use App\Models\SubCategory;


use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      SubCategory::create(
        [
        'category_id' => 1,
        'name' => 'a',
        'slug' => 'a',
        'image' => 'sub-category/2o1SYxz23HS9tjzxNvjUaepsAiMMyYQdwecQVqBi.png',
        'description' => 'adf',
        'is_active' => null,
        'deleted_at' =>null,
        ]);
    }
}
