@extends('layouts.default')

@section('content')
{!! Breadcrumbs::renderIfExists() !!}

<h1>{{$listing->business_name}}</h1>
<p>{{$listing->address_1}},{{ $listing->town }}<br />
{{ $listing->county }} {{ $listing->postcode }}, {{ $listing->country }}
</p>
<p>{{ ( $listing->contact ? $listing->contact : '') }}</p>

<p><button class="btn heart

{{ ($user_favourites->contains(1) ? 'active-heart' : '') }}

" data-listing="{{$listing->id}}"><i class="fa fa-heart"></i></button></p>

@foreach ($listing->galleries as $image)
    <img width="50" height="50" src="{{ URL::asset('/galleries/'.$image->filename) }}">
@endforeach

<script>
$(document).ready(function(){

    $('.heart').on('click',function(){
        var $this=$(this);
        $.ajax({
            type: "POST",
            url: "{{ URL::route('favourite') }}",
            data: {listing_id:{{$listing->id}}},
            dataType: "json",
            success: function (response) {
                if (response=='added') {
                    $this.addClass('active-heart');
                }else if (response=='deleted') {
                    $this.removeClass('active-heart');
                }
            },
            error: function (xhr, status, errorThrown) {
                console.log(xhr.status);
                console.log(xhr.responseText);
            }
        });

    })
});
</script>



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