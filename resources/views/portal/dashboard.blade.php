@extends('layouts.portal')

@section('sidebar')
    <ul>
    <li>My listings</li>
    </ul>
@stop

@section('content')
    <h1>My listings</h1>
    <a class="btn btn-primary" href="">New listing</a>
    <table class="table">
    <tr><th>Business Name</th><th>Status</th><th>Visits</th><th>Actions</th></tr>
    @forelse ($mylistings as $item)
    <tr><td>{{$item->business_name}}</td><td>{!!$item->getStatusClassAttribute()!!}</td><td>{{$item->visits}}</td><td>
    <a class="btn btn-small btn-info" href="{{ URL::route('portal.edit_listing',['id'=>$item->id]) }}"><i class="fa fa-pencil"></i></a>
    {{ Form::open(array('url' => 'nerds/' . $item->id, 'class' => 'pull-right')) }}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::button('<i class="fa fa-trash"></i>', array('type'=>'submit','class' => 'btn btn-warning')) }}
    {{ Form::close() }}
    </td></tr>
    @empty
    <tr><td>You haven't submited anything</td></tr>
    @endforelse
    </table>
    Dashboard !!! a
@stop