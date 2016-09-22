@extends('layouts.default')
@section('sidebar')
    <ul>
    <li>My listings</li>
    </ul>
@stop

@section('content')
@if(isset($listing))
    <h1>Edit Listing</h1>
@else
    <h1>Add Listing</h1>
@endif

@if(Session::has('alert-status'))
<p class="alert alert-success }}">{{ Session::get('alert-status') }}</p>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if(isset($listing))
    {{ Form::model($listing, ['route' => ['portal.edit_listing_handler', $listing->id],'method'=>'patch']) }}
@else
    {{ Form::open(['route' => 'portal.add_listing_handler', 'method' => 'post']) }}
@endif

    <div class="form-group">
    {{ Form::label('business_name','Business Name') }}
    {{ Form::text('business_name',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
    {{ Form::label('contact','Contact') }}
    {{ Form::text('contact',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
    {{ Form::label('display_contact','Display Contact') }}
    {{ Form::radio('display_contact','1',null,['class'=>'']) }} Yes
    {{ Form::radio('display_contact','0',null,['class'=>'']) }} No
    </div>
    <div class="form-group">
    {{ Form::label('address_1','Address 1') }}
    {{ Form::text('address_1',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
    {{ Form::label('display_address','Display Address') }}
    {{ Form::radio('display_address','1',null,['class'=>'']) }} Yes
    {{ Form::radio('display_address','0',null,['class'=>'']) }} No
    </div>
    <div class="form-group">
    {{ Form::label('address_2','Address 2') }}
    {{ Form::text('address_2',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
    {{ Form::label('town','Town') }}
    {{ Form::text('town',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
    {{ Form::label('county','County') }}
    {{ Form::text('county',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
    {{ Form::label('postcode','Postcode') }}
    {{ Form::text('postcode',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
    {{ Form::label('country','Country') }}
    {{ Form::text('country',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
    {{ Form::label('latitude','Latitude') }}
    {{ Form::text('latitude',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
    {{ Form::label('longitude','Longitude') }}
    {{ Form::text('longitude',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
    {{ Form::label('phone','Phone') }}
    {{ Form::text('phone',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
    {{ Form::label('display_phone','Display Phone 2') }}
    {{ Form::radio('display_phone','1',null,['class'=>'']) }} Yes
    {{ Form::radio('display_phone','0',null,['class'=>'']) }} No
    </div>
    <div class="form-group">
    {{ Form::label('phone_2','Phone 2') }}
    {{ Form::text('phone_2',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
    {{ Form::label('display_phone_2','Display Phone 2') }}
    {{ Form::radio('display_phone_2','1',null,['class'=>'']) }} Yes
    {{ Form::radio('display_phone_2','0',null,['class'=>'']) }} No
    </div>
    <div class="form-group">
    {{ Form::label('email','Email') }}
    {{ Form::text('email',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
    {{ Form::label('website','Website') }}
    {{ Form::text('website',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
    {{ Form::label('description','Description') }}
    {{ Form::text('description',null,['class'=>'form-control']) }}
    </div>

    <div class="form-group">
    {{ Form::label('cat_id','Category') }}
    {{ Form::select('cat_id',$cats,null,['class'=>'form-control','placeholder'=>'Pick one']) }}
    </div>
    <div class="form-group">
    {{ Form::label('cat2_id','Category 2') }}
    {{ Form::select('cat2_id',$cats,null,['class'=>'form-control','placeholder'=>'Pick one']) }}
    </div>
    <div class="form-group">
    @if(isset($listing))
        {{ Form::submit('Update',['array'=>'btn btn-primary']) }}
    @else
        {{ Form::submit('Add',['array'=>'btn btn-primary']) }}
    @endif

    </div>
    {{ Form::hidden('user_id','Auth::user()->id') }}
    {{ csrf_field() }}
    {{ Form::close() }}
@endsection