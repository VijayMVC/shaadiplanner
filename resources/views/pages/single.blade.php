@extends('layouts.default')

@section('sidebar')
    @parent
@stop

@section('content')
    <div class="row">
    <div class="col-xs-12">
    <h1>{{$page->title}}</h1>
    <p>{{$page->content}}</p>
    </div>
    </div>
@stop