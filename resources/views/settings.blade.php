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
                @include ('menu')
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

            <div id = "settings-wrap">
                <form action ='savesettings' method = 'post'>
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            Please fix the following errors
                        </div>
                    @endif
                    @foreach ($settings as $setting) 
                        <div class = "pure-g">
                            <input type = "hidden" id = "id" name = "id" value = "{{$setting->id}}" />
                            <div class = "pure-u-1-4"></div>
                            <div class = "pure-u-1-4">{{$setting->name}}</div>
                            <div class = "pure-u-1-4">
                                <div class = "form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                                <input id = "value" name = "value" type = "text" value = "{{$setting->value}}"></input>
                                @if($errors->has('value'))
                                    <span class = "help-block">{{$errors->first('value')}}</span>
                                @endif
                                </div>
                            </div>
                        </div>
                     @endforeach
                        
                    <button type = "submit" class = "btn btn-default">Submit</button>
                   
                </form>
            </div>


        </div>
        <div id = "footer">This is hte footer</div>
        @include ('scripts')
    </body>
</html>
