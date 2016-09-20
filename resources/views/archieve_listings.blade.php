@extends('layouts.default')

@section('content')
{!! Breadcrumbs::renderIfExists() !!}
    @forelse ($listings as $listing)
        @include('partials.listing-loop', array('listing' => $listing))
    @empty
    No listings
    @endforelse
@endsection



@section('sidebar')
    <div class="panel panel-default">
    <div class="panel-heading">ds</div>
    <div class="panel-body">
    <ul class="category-list">
@foreach($cats as $item)
    @if($item->children->count() > 0)
        <li class="dropdown">
             <a href="#">{{ $item->name }} <span class="caret"></span></a>
             <ul class="subcategory-list">
                 @foreach($item->children as $submenu)
                     <li><a href="{{URL::route('listing_categories',['category'=>$submenu->slug]) }}">{{ $submenu->name }}</a></li>
                  @endforeach
             </ul>
       </li>
    @else
        <li><a href="{{URL::route('listing_categories',['category'=>$item->slug]) }}">{{ $item->name }}</a></li>
    @endif
@endforeach
    </ul>
    </div>
    </div>
@endsection