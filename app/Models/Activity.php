<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class activity extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
