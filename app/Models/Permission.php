<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
  public static $guard_name = "admin";

  public function childs()
  {
    return $this->hasMany(Permission::class, 'parent_id', 'id');
  }
}
