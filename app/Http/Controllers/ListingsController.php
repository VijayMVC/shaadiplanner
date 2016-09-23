<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StoreListing;
use App\Listing;
use App\Favourites;
use App\ListingCategories;

class ListingsController extends Controller
{
    public function show($category,$slug) {
        $listing=Listing::where('slug',$slug)->first();
        $cats=ListingCategories::all();
        return view('listing')->with('listing',$listing)->with('cats',$cats);
    }

    public function edit($id) {
        $listing=Listing::find($id);
        $cats=ListingCategories::all()->lists('name','id');
        return view('portal.edit_listing')->with('listing',$listing)->with('cats',$cats);
    }

    public function update($id,StoreListing $request) {

        $listing=Listing::find($id);
        $listing->fill($request->all());
        $listing->save();
        $listing->addToIndex();

        return redirect()->route('portal.edit_listing',[$id])->with('alert-status', 'Listing updated!')->with('alert-class', 'alert-danger');
    }

    public function create() {
        $cats=ListingCategories::all()->lists('name','id');
        return view('portal.edit_listing')->with('cats',$cats);
    }

    public function store(StoreListing $request) {
        $listing=new Listing();
        $listing->fill($request->all());
        $listing->save();
        $listing->addToIndex();
        $cats=ListingCategories::all();
        return view('portal.edit_listing')->with('listing',$listing)->with('cats',$cats);
    }

    public function addFavourite(Request $request) {
        $fav=Favourites::where('listing_id',$request->listing_id)->where('user_id',Auth::user()->id)->first();
        if ($fav === null) {
            $fav=new Favourites();
            $fav->listing_id=$request->listing_id;
            $fav->user_id=Auth::user()->id;
            $fav->save();
            return response()->json('added');
        }else {
            $fav->delete();
            return response()->json('deleted');
        }
    }

    public function search($query) {
        $listings = Listing::search($query);
        $cats=ListingCategories::all();
        return view('archieve_listings')->with('listings',$listings)->with('cats',$cats);
    }
}