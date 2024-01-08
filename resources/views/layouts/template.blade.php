<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @yield('filesjs')
    <title>@yield('title')</title>
</head> 
<body class="bg-blue-200">    
    <div class="header bg-teal-500 text-white p-4 ">
        <div class="title flex items-center justify-center text-4xl">
            <h1>{{ session("usernameLogin") ?? session("usernameSignup") ?? "PRUEBA" }}</h1>

            @if (!is_null(session("logoBand")) && file_exists(session("logoBand")))
                <img src="{{ session("logoBand") }}" alt="Band Logo" class="band-logo max-w-13vw ml-10">
            @endif
        </div>
        <nav>
            <ul class="flex items-center text-2xl">
                <li><a href="{{route('main')}}" class="text-white ml-4">Home</a></li>
                <li><a href="{{route('registration')}}" class="text-white ml-4">Instrument registration</a></li>
                <li><a href="#" class="text-white ml-4">Help</a></li>
                <li id="last-item" class="ml-auto float-right"><a href="" class="text-white">Logout</a></li>
            </ul>
        </nav>        
    </div>
    
    
    @yield('content')

    <div class="googleAds border-t-2 border-teal-500 text-center bg-white bottom-0 left-0 w-full p-4">
        <h1>GOOGLE ADS</h1>
    </div>
</body>
</html>