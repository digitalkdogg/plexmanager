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
                <form action ='savesettings' id = 'savesettings' method = 'post' class = "border-radius-std pure-form">
                    @csrf
                    <div id = "error-wrap">
                        <div class="alert alert-danger" role="alert">
                            Please fix the following errors
                        </div>
                    </div>

                        <div class = "pure-g border-bottom-std">
                            <div class = "pure-u-1-4"></div>
                            <div class = "pure-u-1-4"><b>Nmae</b></div>
                            <div class = "pure-u-1-4"><b>Value</b></div>
                        </div>
                    @foreach ($settings as $setting) 
                        <div class = "pure-g" id = "setting_{{$setting->id}}" data-id="{{$setting->id}}" data-name = "{{$setting->name}}" data-value = "{{$setting->value}}">
                            <div class = "pure-u-1-4"></div>
                            <div class = "pure-u-1-4">{{$setting->name}}</div>
                            <div class = "pure-u-1-4">
                                <div class = "form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                                <input id = "{{$setting->id}}" name = "value" type = "text" value = "{{$setting->value}}" data-id="{{$setting->id}}"></input>
                                @if($errors->has('value'))
                                    <span class = "help-block">{{$errors->first('value')}}</span>
                                @endif
                                </div>
                            </div>
                        </div>
                     @endforeach
                        
                    <button type = "submit" id="save-settings" class = "pure-button pure-button-primary">Submit</button>
                   
                </form>
            </div>


        </div>
        <div id = "footer">This is hte footer</div>
        @include ('scripts')
    </body>
</html>
