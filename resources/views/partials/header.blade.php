<!-- nav -->
<nav class="navbar navbar-expand-lg py-1 z-3">
    <div class="container">

        <!-- logo -->
        <div class="logo">
            <a class="nav-link" href="{{ url('/') }}">
                <img src="{{ asset('img/Boolbnb-logo.png') }}" alt="Boolbnb logo">
            </a>
        </div>

        <!-- burguer menu on mobile and tablet-->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon icona-cl"></span>
        </button>

        <!-- links -->
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mb-2 mb-lg-0">

                <!-- home -->
                <li>
                    <a class="nav-link home" href="http://localhost:5174/">
                        <i class="fa-solid fa-house-user me-2"></i>                            
                        <span>
                            {{ __('Home') }}
                        </span>
                    </a>
                </li>

                <!-- Authentication Links -->
                @guest
                    <!-- login -->
                    <li>
                        <a class="nav-link" href="{{ route('login') }}"> {{ __('Login') }}</a>
                    </li>

                    <!-- register -->
                    @if (Route::has('register'))
                        <li>
                            <a class="nav-link" href="{{ route('register') }}">
                                {{ __('Registrazione') }}
                            </a>
                        </li>
                    @endif
                @else
                    <li>
                        <a class="nav-link" href="{{ route('admin.index') }}">
                            <i class="fa-solid fa-building me-2"></i>
                            <span>
                                {{ __('Appartamenti') }}
                            </span>                                
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('admin.create') }}"> <i class="fa-solid fa-building-user me-2"></i>
                            <span>
                                {{ __('Pubblica Appartamenti') }}
                            </span>
                        </a>
                    </li>

                    {{-- dropdown --}}
                    <li class="nav-item dropdown">
                        @if(Auth::user()->name)
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                        @else
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-regular fa-user me-2"></i>
                                <span>
                                    {{ __('Utente') }}
                                </span>
                            </a>
                        @endif

                        {{-- menu dropdown --}}
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item prova mx-2" href="{{ url('dashboard') }}">
                                {{__('Dashboard')}}
                            </a>
                            <a class="dropdown-item prova mx-2" href="{{ url('profile') }}">
                                {{__('Profilo')}}
                            </a>
                            <a class="dropdown-item prova mx-2" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Esci') }}
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