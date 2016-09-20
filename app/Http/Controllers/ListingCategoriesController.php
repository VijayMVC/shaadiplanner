<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Listing;
use App\ListingCategories;

class ListingCategoriesController extends Controller
{
    public function show($category) {
        $category=ListingCategories::where('slug',$category)->first();
        $listings=Listing::where('cat_id',$category->id)->get();
        $cats=ListingCategories::all();
        return view('archieve_listings')->with('listings',$listings)->with('cats',$cats);
    }
}
