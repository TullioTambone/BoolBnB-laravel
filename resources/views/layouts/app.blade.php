<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
    @vite(['resources/scss/pages/_nav.scss'])
    @yield('script')
</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid d-flex justify-content-between">
                <div>
                    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                        <div class="logo_laravel">
                            <h1>BoolBnB</h1>
                        </div>
                        {{-- config('app.name', 'Laravel') --}}
                    </a>
                </div>
    
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li>
                            <a class="nav-link home" href="http://localhost:5174/"> <i class="fa-solid fa-house-user"></i> {{ __('Home') }}</a>
                        </li>    
                   
                        <!-- Authentication Links -->
                        @guest
                        <li>
                            <a class="nav-link" href="{{ route('login') }}"> {{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li>
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrazione') }}</a>
                        </li>
                        @endif
                        @else
                        <li>
                            <a class="nav-link" href="{{ route('admin.index') }}"> <i class="fa-solid fa-building"></i>  Appartamenti</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('admin.create') }}"> <i class="fa-solid fa-building-user"></i> Pubblica Appartamenti</a>
                        </li>
                        <li class="nav-item dropdown">
                            @if(Auth::user()->name)
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{ Auth::user()->name }}
                                </a>
                            @else
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-regular fa-user"></i>  Utente
                                </a>
                            @endif
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item prova mx-2" href="{{ url('dashboard') }}">{{__('Dashboard')}}</a>
                                <a class="dropdown-item prova mx-2" href="{{ url('profile') }}">{{__('Profilo')}}</a>
                                <a class="dropdown-item prova mx-2" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    

        <main class="">
            @yield('content')
        </main>

        @yield('braintree')
    </div>
</body>

</html>
