<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListingCategories extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'listing_categories';

    public function listings()
    {
        return $this->hasMany('App\Post','cat_id','id');
    }

    public function parent()
    {
        return $this->belongsTo('App\ListingCategories', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\ListingCategories', 'parent_id');
    }
}
