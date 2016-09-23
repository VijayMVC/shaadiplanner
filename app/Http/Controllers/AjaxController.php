<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Listing;
use Response;

class AjaxController extends Controller
{
    public function suggest(Request $request){
        $options=array();
        //$listings = Listing::search($request->term);
        $listings = Listing::searchByQuery(["wildcard" => ['_all' => "$request->term*"]]);
        foreach($listings  as $listing) {
           $options[] = array(
            'title'    => $listing->business_name
            );
        }
        return response()->json($options);
    }
}
