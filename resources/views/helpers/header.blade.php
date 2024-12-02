<header class="header">
    <div class="logo-container">
        <a class="logo" href="{{ route('home')}}"><img src="{{ url('/images/TravelBridgeLogo2.png') }}"  alt="logo"></a>
        <h2>TravelBridge</h2>
    </div>
    <div class="menu-container">
        <nav class="menu">
            <a href="{{ route('home') }}">{{ __('Home') }}</a>
            <a href="{{ route('destinations') }}">{{ __('Destinations') }}</a>
            <a href="{{ route('accommodation') }}">{{ __('Accommodation') }}</a>
            <a href="{{ route('activities') }}">{{ __('Activities') }}</a>
        </nav>
    </div>
    <div class="auth-buttons">
        @guest
            @if (Route::has('login'))
                <button class="login-btn">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </button>
            @endif
            @if (Route::has('register'))
                <button class="register-btn">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </button>
            @endif
        @else
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarNavDropdown"><ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">{{ __('') }}</a></li>
                                <li><a class="dropdown-item" href="#">{{__('Account settings')}}</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item logout-link" href="{{ route('logout') }}">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        @endguest
    </div>
</header>
