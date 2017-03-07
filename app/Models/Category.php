<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;

class Category extends Model
{
    use ModelTree, AdminBuilder;

    protected $guarded = ['id'];

    public function activity()
    {
        return $this->hasMany('App\Models\Activity');
    }
}
