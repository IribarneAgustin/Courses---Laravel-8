<x-guest-layout>

    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <div class="main">
        <p class="sign" style="text-align:center">Bienvenido!</p>
        <br>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <input id="email" class="un" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
            </div>

            <div class="mt-4">
                <input class="pass" id="password" class="block mt-1 w-full" type="password" placeholder="Contraseña" name="password" required autocomplete="current-password" />
            </div>

            <button type="submit" class="submit" style="text-align:center">Ingresar</button>

            @if (Route::has('password.request'))
            <p class="forgot" style="text-align:center"><a href="{{ route('password.request') }}">Olvidaste tu contraseña?</p>
            </a>
            @endif
            <p style="text-align:center"><a href="{{ route('register') }}">Registrarse!</p>
            </a>
            <div class="text-center">
                <x-jet-validation-errors class="mb-4" />
            </div>

        </form>
    </div>


</x-guest-layout>
