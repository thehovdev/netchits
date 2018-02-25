<!DOCTYPE HTML>
<html>

    <head>
        @include('layouts.header')
    </head>

    <body>
        <div class="container">
            <div class="row">
                @include('layouts.includes.user-sidebar')
                @include('layouts.includes.bot-sidebar')


                @if(@$sidebar != 'false')
                    <div class="col-sm-8 col-sm-offset-2">
                        @yield('content')
                    </div>
                @else
                    <div class="col-sm-12">
                        @yield('content')
                    </div>
                @endif



            </div>
        </div>

    </body>

    <footer>
        @include('layouts.footer')
    </footer>

</html>
