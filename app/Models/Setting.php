<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

     protected $fillable = ['name','email','phone','address','site_logo','description','facebook','twitter','instagram','copyright','created_at','updated_at'];
}