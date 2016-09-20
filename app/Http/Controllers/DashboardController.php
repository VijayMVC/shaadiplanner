<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Listing;
use Auth;

class DashboardController extends Controller
{
    public function index() {
        $mylistings=Listing::where('user_id',Auth::user()->id)->get();
        return view('portal.dashboard')->with('mylistings',$mylistings);
    }
}
