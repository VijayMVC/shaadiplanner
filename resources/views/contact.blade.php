@extends('layouts.default')

@section('content')
{!! Breadcrumbs::renderIfExists() !!}

{{ Form::open() }}
<div class="form-group">
{{ Form::label('name','Name') }}
{{ Form::text('name',null,['class'=>'form-control']) }}
</div>
<div class="form-group">
{{ Form::label('email','Email') }}
{{ Form::email('email',null,['class'=>'form-control']) }}
</div>
<div class="form-group">
{{ Form::label('message','Message') }}
{{ Form::textarea('message',null,['class'=>'form-control']) }}
</div>
{{ Form::submit('Send',['class'=>'btn btn-primary']) }}

@endsection