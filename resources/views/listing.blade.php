@extends('layouts.default')

@section('content')
{!! Breadcrumbs::renderIfExists() !!}

<h1>{{$listing->business_name}}</h1>
<p>{{$listing->address_1}},{{ $listing->town }}<br />
{{ $listing->county }} {{ $listing->postcode }}, {{ $listing->country }}
</p>
<p>{{ ( $listing->contact ? $listing->contact : '') }}</p>

@foreach ($listing->galleries as $image)
    <img width="50" height="50" src="{{ URL::asset('/galleries/'.$image->filename) }}">
@endforeach

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