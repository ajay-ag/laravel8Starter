<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Setting;

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Setting::create([
        'name' => 'general_settings',
        'response' => '{"store_name":"Lara Fresh","email":"admin@admin.com","contact":"9099102911","country":"India","state":"Gujrat","city":"Rajkot","postal_code":"360003","address":"Santkabir Road Rajkot ,\r\nRajaram Socity Street No.4\r\nRajkot 360003\r\nGujrat - India","copyrights":"Copyright \u00a9 2020 Gift Master. All rights reserved.","facebook":"https:\/\/eshop.test\/admin\/settings","instagram":"https:\/\/eshop.test\/admin\/settings","whatsapp":"https:\/\/eshop.test\/admin\/settings","linkedin":"https:\/\/eshop.test\/admin\/settings","offertext":"https:\/\/eshop.test\/admin\/settings ## https:\/\/eshop.test\/admin\/settings","logo":"setting\/C5pTFFlSRtIxilMxfRGHyPG2OysvJQqDbhCw2w3u.svg","favicon":"setting\/Coo0M2jUiXxjH3hHFmngoRfCNXzRMEbwMI7KRpTy.svg"}'
      ]);
    }
}
