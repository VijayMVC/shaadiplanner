<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kodeine\Metable\Metable;

class Page extends Model
{
    use Metable;
    protected $metaTable = 'pages_meta';
    protected $dates = ['deleted_at'];
    protected $table = 'pages';
}
