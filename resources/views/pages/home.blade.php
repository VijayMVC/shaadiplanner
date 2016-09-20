@extends('layouts.default')

@section('sidebar')
    @parent
@stop

@section('content')
    <div class="panel panel-default search-block">
        <form id="search_form" class="form-horizontal" action="/results" method="get" onsubmit="return validateSearchForm()">
            <div class="col-lg-6">
                <div class="form-group field-q">
                    <label class="control-label" for="q">Search for...</label>
                    <input type="text" id="q" class="form-control ui-autocomplete-input" name="q" autocomplete="off">
                    <input type="hidden" id="cat" name="cat" autocomplete="off">
                </div>
            </div>
            <div class="col-lg-5">
                <div class="form-group field-location">
                    <label class="control-label" for="location">Near...</label>
                    <input type="text" id="location" class="form-control" name="location">
                    <div class="hint-block">e.g. Postcode or City</div>
                </div>
            </div>
            <div class="col-lg-1">
                <button type="submit" id="main_search" class="btn btn-primary" style="margin-top:27px">Search</button>
            </div>
            <div class="clear"></div>
        </form>
    </div>
@stop