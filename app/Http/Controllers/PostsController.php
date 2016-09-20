<?php

namespace WebExpert\Http\Controllers;
use WebExpert\Http\Controllers\Controller;
use Illuminate\Http\Request;
use WebExpert\Http\Requests;
use WebExpert\Post;

class PostsController extends Controller
{
    public function show($category,$article) {
        $post=Post::where('slug',$article)->first();
        $related=Post::where('id','!=',$post->id)->where('cat_id',$post->category->id)->orderBy('title', 'asc')->take(5)->get();
        return view('posts.post', ['post' => $post, 'related'=>$related]);
    }
}
