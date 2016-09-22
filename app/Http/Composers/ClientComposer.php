<?php

namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use Auth;

class ClientComposer {

    public function compose(View $view)
    {
        if (Auth::check()) {
            $user_favourites=Auth::user()->favourites->lists('listing_id');
            $view->with('user_favourites',$user_favourites);
         }

    }

}

?>