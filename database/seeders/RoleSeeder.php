<?php

namespace Database\Seeders;

use App\Models\Role;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $array = [
      [
        'name' => 'Super Admin',
        'slug' => 'super-admin',
        'guard_name' => 'admin',
        'is_active' => '2021-06-05 08:21:06',
      ],
      [
        'name' => 'Admin',
        'slug' => 'admin',
        'guard_name' => 'admin',
        'is_active' => '2021-06-05 08:21:06',
      ],
      [
        'name' => 'Editor',
        'slug' => 'editor',
        'guard_name' => 'admin',
        'is_active' => '2021-06-05 08:21:05',
      ]
    ];
    foreach ($array as $key => $row) {
      Role::create($row);
    }
  }
}