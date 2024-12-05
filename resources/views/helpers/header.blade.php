<header class="header">
    <div class="logo-container">
        <a class="logo" href="{{ route('home')}}"><img src="{{ url('/images/TravelBridgeLogo2.png') }}"  alt="logo"></a>
        <h2>TravelBridge</h2>
    </div>
    <div class="menu-container">
        <nav class="menu">
            <a href="{{ route('home') }}">{{ __('messages.Home') }}</a>
            <a href="{{ route('destinations') }}">{{ __('messages.Destinations') }}</a>
            <a href="{{ route('accommodation') }}">{{ __('messages.Accommodation') }}</a>
            <a href="{{ route('activities') }}">{{ __('messages.Activities') }}</a>
        </nav>
    </div>
    <div class="auth-buttons">
        @guest
            @if (Route::has('login'))
                <button class="login-btn">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a>
                </button>
            @endif
            @if (Route::has('register'))
                <button class="register-btn">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('messages.Register') }}</a>
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
                                @if(!auth()->user()->isAdmin())
                                    <li><a class="dropdown-item" href="{{ route('likelist.index') }}">{{ __('messages.LikeList') }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('trips.index') }}">{{ __('messages.MyTrips') }}</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item logout-link" href="{{ route('logout') }}">
                                        {{ __('messages.Logout') }}
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
