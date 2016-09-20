<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategories extends Model
{
    use SoftDeletes;
    protected $table = 'post_categories';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'slug'];

    public function posts()
    {
        return $this->hasMany('App\Post','cat_id','id');
    }
}
