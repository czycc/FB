<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'price', 'number', 'img', 'description'];

    protected $dates = ['deleted_at'];
}
