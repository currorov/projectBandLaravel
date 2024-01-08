<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="{{ asset('js/scriptLogin.js') }}"></script>
    <title>Log In</title>
</head>
<body class="flex justify-center items-center min-h-screen bg-gradient-to-b from-f7f7f7 to-AFF5F7">
    
    <div class="mx-auto max-w-lg bg-white rounded-5 shadow-2xl p-5 text-center min-w-[650px] !important" id="login-form" @if(!session('activeForm')  || session('activeForm') == 'login') style="display:block;" @else style="display:none;" @endif>
        <h1 class="text-3xl md:text-4xl lg:text-5xl mb-7 text-teal-500">Log in</h1>
        <form action="{{route('login')}}" method="POST">
            @csrf
            <input type="text" name="usernameLogin" id="usernameLogin" placeholder="Username" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl @error('usernameLogin') border-red-500 @enderror">
            @error('usernameLogin')
                <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
            @enderror

            <input type="password" name="passwordLogin" id="passwordLogin" placeholder="Password" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl @error('passwordLogin') border-red-500 @enderror">
            @error('passwordLogin')
                <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
            @enderror

            <p class="mt-4 text-sm md:text-base">
                Don't have an account? <a id="show-register" class="clickable-text text-blue cursor-pointer text-teal-500 hover:text-teal-700 hover:underline">Sign up</a>
            </p>
            <p class="mb-4 text-sm md:text-base">
                <a id="show-recoverPassword" class="clickable-text text-blue cursor-pointer text-teal-500 hover:text-teal-700 hover:underline">Forgot your password?</a>
            </p>
            <button type="submit" class="w-full p-4 bg-teal-500 text-white border-none rounded-5 text-lg md:text-xl lg:text-2xl cursor-pointer transition duration-300 hover:bg-teal-700">Login</button>
        </form>
    </div>

    <div class="mx-auto max-w-lg bg-white rounded-5 shadow-2xl p-5 text-center hidden" id="register-form" @if(session('activeForm') == 'register') style="display:block;" @else style="display:none;" @endif>
        <h1 class="text-3xl md:text-4xl lg:text-5xl mb-7 text-teal-500">Sign Up</h1>
        <form action="{{route('register')}}" method="POST" enctype="multipart/form-data"> 
            @csrf
            <input type="text" name="nameSingup" id="nameSingUp" placeholder="Name" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl">
            @error('nameSingup')
                <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
            @enderror
            
            <input type="text" name="usernameSingup" id="usernameSingup" placeholder="Username" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl">
            @error('usernameSingup')
                <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
            @enderror
            
            <input type="text" name="mailSingup" id="mailSingup" placeholder="Mail"  pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Please enter a valid email address" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl">
            @error('mailSingup')
                <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
            @enderror
            
            <input type="password" name="passwordSingup" id="passwordSingup" placeholder="Password"class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl" >
            @error('passwordSingup')
                <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
            @enderror
            
            <input type="password" name="confirmPasswordSingup" id="confirmPasswordSingup" placeholder="Confirm Password" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl">
            @error('confirmPasswordSingup')
                <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
            @enderror
            
            <label>Select logo:</label>
            <input type="file" name="photoSingup" id="photoSingup" accept="image/*" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl"> <!-- No es obligado introducir una foto -->
            <p class="mt-4 mb-4 text-sm md:text-base">
                Do you already have an account?  <a id="show-login" class="clickable-text text-blue cursor-pointer text-teal-500 hover:text-teal-700 hover:underline">Log in</a>
            </p>
            <button type="submit" class="w-full p-4 bg-teal-500 text-white border-none rounded-5 text-lg md:text-xl lg:text-2xl cursor-pointer transition duration-300 hover:bg-teal-700">Register</button>
        </form>
    </div>

    <div class="mx-auto max-w-lg bg-white rounded-5 shadow-2xl p-5 text-center hidden" id="recoverPassword" @if(session('activeForm') == 'recoverPassword') style="display:block;" @else style="display:none;" @endif>
        <h1 class="text-3xl md:text-4xl lg:text-5xl mb-7 text-teal-500">Recover Password</h1>
        <form action="{{route('recoverPassword')}}" method="POST"> 
            @csrf
            <input type="text" name="mailRecoverPassword" id="mailRecoverPassword" placeholder="Mail" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl">
            @error('mailRecoverPassword')
                <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
            @enderror
            
            <p class="mt-4 mb-4 text-sm md:text-base">
                <a id="show-login-recover" class="clickable-text text-blue cursor-pointer text-teal-500 hover:text-teal-700 hover:underline">Go back  </a>
            </p>
            <button type="submit" class="w-full p-4 bg-teal-500 text-white border-none rounded-5 text-lg md:text-xl lg:text-2xl cursor-pointer transition duration-300 hover:bg-teal-700">Send Mail</button>
        </form>
    </div>

</body>
</html>
