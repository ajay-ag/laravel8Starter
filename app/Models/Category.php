<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
  use HasFactory, SoftDeletes;

  public function getImageSrcAttribute()
  {
    if ($this->image && Storage::exists($this->image)) {
      return asset('storage/'.$this->image);
    }
    return asset('storage/category/default.jpg');
  }
}
