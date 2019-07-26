<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Plex Manager - Scan</title>

        <!-- Styles -->
        @include ('styles')    
        <!-- end styles -->
      


    </head>
    <body>
        <div id = "header-container">
            <div id = "header">Plex Manager</div>
                @include ('menu');
        </div>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            @foreach ($movies as $movie) 
                <div class="content pure-g movie-row-container">
                    <div class = "pure-u-1-3"></div>
                    <div class = "pure-u-1-3">{{$movie['title']}}</div>
                    <div class = "pure-u-1-3"></div>
                </div>
             @endforeach

        </div>
        <div id = "footer">This is hte footer</div>

        @include ('scripts');
    </body>

</html>
