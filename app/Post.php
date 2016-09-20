<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kodeine\Metable\Metable;

class Post extends Model
{
    use Metable;
    protected $metaTable = 'posts_meta';
    protected $dates = ['deleted_at'];
    protected $table = 'posts';

    public function category()
    {
        return $this->belongsTo('App\PostCategories','cat_id','id');
    }
}
