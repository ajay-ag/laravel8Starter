<?php

namespace Database\Seeders;
use App\Models\Newsletter;

use Illuminate\Database\Seeder;

class NewsletterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Newsletter::create([
       'email'=> 'Bjp@gmail.com',
      ]);
    }
}
