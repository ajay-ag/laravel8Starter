<?php

namespace Database\Seeders;

use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;

class CreateAdminSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // $admin = Admin::create([
    //   'name' => 'Hardik Savani',
    //   'email' => 'jps@gmail.com',
    //   'password' => '$2y$10$BzSUXFaxw.dbagsrOAPQHu8EExsVSvw8JmNYK7cxlzowVgQCThfJ2'
    // ]);

    // $role = Role::create(['name' => 'Writer', 'slug' => 'writer']);

    // $permissions = Permission::pluck('id', 'id')->all();

    // $role->syncPermissions($permissions);

    // $admin->assignRole([$role->id]);

    $superAdmin = Admin::create(['first_name' => 'Super', 'last_name' => 'Admin', 'name' => 'super-admin', 'email' => 'superadmin@gmail.com', 'email_verified_at' => now()->format('Y-m-d H:i:s'), 'password' => Hash::make('12345678')]);
    $superAdmin->assignRole('Super Admin');
  }
}