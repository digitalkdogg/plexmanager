<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Plex Manager - Home</title>

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
  
            <div class="content pure-g movie-container">
             @foreach ($movies as $movie) 

                 <div class = "pure-u-1-4 movie" id = "id_{{ $movie->id }}" data-bg = "{{$movie->thumbnail}}">
                    <div class = "overlay">
                        <br />Title : {{$movie->name}}<br />
                        Key : {{$movie->key}}<br />
                        Format : {{$movie->format}}<br />
                    </div>
                </div>
             @endforeach
            
            </div>

        </div>
          <div id = "footer">This is hte footer</div>

          @include ('scripts');
    </body>
</html>
