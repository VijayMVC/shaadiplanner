<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\PostCategories;

class PostCategoriesController extends Controller
{
    public function show($slug) {
        $categories=PostCategories::where('slug',$slug)->first();
        $posts=$categories->posts;
        return view('posts.archieve', ['categories' => $categories,'posts' => $posts]);
    }
}
