<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kodeine\Metable\Metable;

class Listing extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'listings';

    public function category() {
        return $this->belongsTo('App\ListingCategories');
    }
}
