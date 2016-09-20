<?php

use App\Listing;

Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('frontpage'));
});

Breadcrumbs::register('show_page', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
});

Breadcrumbs::register('view_listing', function($breadcrumbs,$category,$listing)
{
    $listing=Listing::where('slug',$listing)->first();
    $breadcrumbs->parent('home');
    $breadcrumbs->push($listing->category->name, route('listing_categories',['category'=>$category]));
    $breadcrumbs->push($listing->business_name, route('view_listing',['category'=>$category,'slug'=>$listing->id]));
});

?>