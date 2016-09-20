<!DOCTYPE html>
<html>
    <head>
        @include('includes.head')
    </head>
    <body>
        <div class="wrap">
            @include('includes.header')

            <div class="container">
            <div class="row">
            @if(View::hasSection('sidebar'))
                <div class="col-xs-8">@yield('content')</div>
                <div class="col-xs-4">@yield('sidebar')</div>
            @else
                <div class="col-xs-12">@yield('content')</div>
            @endif
            </div>
            </div>
        </div>
        @include('includes.footer')
    </body>
</html>
