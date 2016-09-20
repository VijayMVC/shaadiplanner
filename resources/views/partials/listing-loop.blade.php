<div class="listing-item">
<h2>{{ $listing->business_name }}</h2>
<p>{{ $listing->description }}<br />
{{ $listing->town }}, {{$listing->country}}</p>
<a href="{{URL::route('view_listing',['category'=>$listing->category->slug,'slug'=>$listing->slug]) }}">View more</a>
</div>