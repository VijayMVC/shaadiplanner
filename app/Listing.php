<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kodeine\Metable\Metable;
use Elasticquent\ElasticquentTrait;

class Listing extends Model
{
    use SoftDeletes;
    use ElasticquentTrait;
    protected $dates = ['deleted_at'];
    protected $table = 'listings';
    protected $fillable = ['business_name','contact','display_contact','address_1','address_2','town','county','postcode','country','latitude','longitude','display_address','phone','display_phone','phone_2','display_phone_2','email','website','description','cat_id','cat2_id','listing_type','user_id','status'];

    public function category() {
        return $this->belongsTo('App\ListingCategories','cat_id','id');
    }

    public function galleries() {
        return $this->hasMany('App\Gallery');
    }

    public function getStatusClassAttribute() {
        if ($this->attributes['status']==0) {
            $class="danger";
        }elseif ($this->attributes['status']==1) {
            $class="success";
        }
        return '<span class="label label-'.$class.'">'.$this->getStatusText().'</span>';
    }

    public function getStatusText() {
        if ($this->attributes['status']==0) {
            return $class="inactive";
        }elseif ($this->attributes['status']==1) {
            return $class="active";
        }
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d/m/Y');
    }
}
