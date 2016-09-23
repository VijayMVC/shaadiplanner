<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Page;
use App\Listing;

class PagesController extends Controller
{
    public function show($page) {
        $page=Page::where('slug',$page)->first();
        return view('pages.single')->with('page',$page);
    }
    public function frontpage() {
        $listings=Listing::where('status',1)->orderBy('created_at','DESC')->get();
        return view('index')->with('listings',$listings);
    }

    public function contact() {
        return view('contact');
    }

}
