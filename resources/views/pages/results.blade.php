@extends('layouts.default')

@section('title')
    {{ $geo['q'] }} near {{ $geo['geo']['formatted_address'] }} - {{ config('app.site_name') }}
@stop

@section('sidebar')
    @parent

@stop

@section('content')
    <div class="business-results">
        <div class="row">
            <div class="col-lg-12">
                @if(isset($geo['error']))
                    <div class="search-error" style="color:red">{{ $geo['error'] }}</div>';
                @else
                    <h3>&quot;{{ $geo['q'] }}&quot; near {{ $geo['geo']['formatted_address'] }}</h3>
                @endif


                @foreach ($results as $result)
                    <div class="item">
                        <h4>{{ $result->_source->business_name }}</h4>
                        <?php
                            $full_address = "";
                            if($result->_source->location->display_address){
                                $full_address .= $result->_source->location->address_1.", ";
                                if(!empty($result->_source->location->address_2)){ $full_address .= $result->_source->location->address_2.", "; }
                            }
                            else{
                                $full_address .= "[Address Hidden], ";
                            }
                            $full_address .= $result->_source->location->town.", ";
                            $full_address .= $result->_source->location->county;
                            if($result->_source->location->display_address){
                                $full_address .= ", ".$result->_source->location->postcode;
                            }
                            $full_address .= ", ".$result->_source->location->country;

                            $distance = number_format(current($result->sort), 2);
                        ?>
                        {{ $full_address }}<br />
                        {{ $result->_source->category_name }}<br />
                        <b>Distance: {{ $distance }} mile{{ $distance == 1 ? '' : 's' }}</b><br>
                    </div>
                @endforeach
        </div>
    </div>
@stop