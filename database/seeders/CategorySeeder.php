<?php

namespace Database\Seeders;
use App\Models\Category;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Category::create([
        'name' => 'Car',
        'slug' => 'car',
        'image' => 'category/tBESvV9D3w9K55tnKFbEiV3ydsY5ZmLkke441BLB.png',
        'description' => 'adf',
        'is_active' => null,
        'deleted_at' =>null
      ]);
    }
}
