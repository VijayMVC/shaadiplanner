<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Listing;
use App\ListingCategories;

class ListingsController extends Controller
{
    public function show($category,$slug) {
        $listing=Listing::where('slug',$slug)->first();
        $cats=ListingCategories::all();
        return view('listing')->with('listing',$listing)->with('cats',$cats);
    }
}
