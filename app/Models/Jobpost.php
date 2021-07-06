<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobpost extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'city',
      'price',
      'description',
      'name',
      'phonenumber'
  ];
}
