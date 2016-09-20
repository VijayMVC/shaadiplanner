<!DOCTYPE html>
<html>
    <head>
        @include('includes.head')
    </head>
    <body>
        <div class="wrap">
            @include('includes.portal_header')

            <div class="container">
                @yield('content')
            </div>
        
        </div>
        @include('includes.footer')
    </body>
</html>
