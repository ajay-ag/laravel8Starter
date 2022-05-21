<?php

namespace Database\Seeders;
use App\Models\Contact;

use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Contact::create([
        'name' => 'Bhavinparmar',
        'email' => 'kcp@gmail.com',
        'phone' => '8200059456',
        'subject' => 'adf',
        'comment' => 'No',
      ]);
    }
}
