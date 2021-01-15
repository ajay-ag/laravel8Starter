<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
  public static $guard_name = "admin";

  public function childs()
  {
    return $this->hasMany(Permission::class, 'parent_id', 'id');
  }
}
