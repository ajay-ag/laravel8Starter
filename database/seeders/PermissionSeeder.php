<?php

namespace Database\Seeders;

use App\Models\Permission;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
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
        'parent_id' => 1,
        'name' => 'Users',
        'slug' => 'users',
        'icon' => 'admin',
        'guard_name' => 'admin',
        'is_active' => '2021-06-05 02:51:06',
      ],
      [
        'parent_id' => 2,
        'name' => 'Add',
        'slug' => 'add',
        'icon' => 'admin',
        'guard_name' => 'admin',
        'is_active' => '2021-06-05 02:51:06',
      ],
      [
        'parent_id' => 2,
        'name' => 'Edit',
        'slug' => 'edit',
        'icon' => 'admin',
        'guard_name' => 'super admin',
        'is_active' => '2021-06-05 02:51:06',
      ],
    ];
    foreach ($array as $key => $row) {
      Permission::create($row);
    }
  }
}