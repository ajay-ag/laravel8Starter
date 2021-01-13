<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Helper
{
  public static function isActive($routePattern = null, $class = 'active', $prfix = 'admin.')
  {
    // Convert to array
    $name = Route::currentRouteName();

    if (!is_array($routePattern) && $routePattern != null) {
      $routePattern = explode(' ', $routePattern);
    }

    foreach ((array) $routePattern as $i) {
      if (Str::is($prfix . $i, $name)) {
        return $class;
      }
    }

    foreach ((array) $routePattern as $i) {
      if (Str::is($i, $name)) {
        return $class;
      }
    }
  }
}
