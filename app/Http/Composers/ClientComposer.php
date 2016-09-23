<?php

namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use Auth;

class ClientComposer {

    public function compose(View $view)
    {
        $fav = new \Illuminate\Database\Eloquent\Collection;
        if (Auth::check()) {
            $fav=Auth::user()->favourites->lists('listing_id');
         }
         $view->with('user_favourites',$fav);

    }

}

?>