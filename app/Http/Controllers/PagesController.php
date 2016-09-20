<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;

class PagesController extends Controller
{
    public function show($page) {
        return 0;
    }
    public function frontpage() {
        return view('pages.home');
    }

    public function contact() {
        return 0;
    }
}
