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

            <div id = "scan-wrap">

                <form class = "pure-form">
                    <div class="content pure-g movie-row-header border-bottom-std" >
                             <div class = "pure-u-1-8 status"><b>Status</b></div>
                            <div class = "pure-u-1-6 key"><b>Key</b></div>
                            <div class = "pure-u-1-6 name"><b>Title</b></div>
                            <div class = "pure-u-1-8"><b>Format</b></div>
                            <div class = "pure-u-1-8"><b>Thumbnail</b></div>
                            <div class = "pure-u-1-8">test</div>
                            <div class = "pure-u-1-8">test</div>
                        </div>
                    @foreach ($movies as $movie) 
                        <div class="content pure-g movie-row-container" id = "movie-{{$movie['key']}}" >
                             <div class = "pure-u-1-8 status"></div>
                            <div class = "pure-u-1-6 key">{{$movie['key']}}</div>
                            <div class = "pure-u-1-6 name">{{$movie['title']}}</div>
                            <div class = "pure-u-1-8 format">{{$movie['format']}}</div>
                            <div class = "pure-u-1-8 thumbnail">{{$movie['thumb']}}</div>
                            <div class = "pure-u-1-8">test</div>
                            <div class = "pure-u-1-8">test</div>

                        </div>
                    @endforeach

                    <button id = "save-scan" class = "pure-button pure-button-primary">Save</button><span id = "status-wrap"></span>
                </form>
            </div>

        </div>
        <div id = "footer">This is hte footer</div>

        @include ('scripts');
    </body>

</html>
