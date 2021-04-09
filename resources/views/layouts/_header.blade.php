<nav class="navbar navbar-expand-md navbar-dark bg-info sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
        <i class="fas fa-coins"></i> {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @auth
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="{{ route('companies.index') }}" class="nav-link active">
                            <i class="fas fa-building"></i> Company Master
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('groups.index') }}" class="nav-link">
                        <i class="fas fa-users"></i> Group Master
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-code-branch"></i> Branch Master
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('currencies.index') }}" class="nav-link">
                            <i class="fas fa-pound-sign"></i> Currencies
                        </a>
                    </li>

                    
                    <li class="nav-item">
                        <a href="{{ route('currencies') }}" class="nav-link">
                            <i class="fas fa-pound-sign"></i> Currencies Api
                        </a>
                    </li>
                    

                    <li class="nav-item">
                        <a href="{{ route('exchanges.index') }}" class="nav-link">
                        <i class="fas fa-exchange-alt"></i> Exchange
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-desktop"></i> Screens
                        </a>

                       

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            
                            <a href="{{ route('screen1') }}" class="dropdown-item">
                                Screen1
                            </a>
                
                        </div>
                    </li>

                    
                </ul>
            @endauth

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i>
                                {{ __('Login') }}
                            </a>
                        </li>
                    @endif
                    
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus"></i>    {{ __('Register') }}
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{ route('profile', ['id' => Auth::user()->id]) }}" class="dropdown-item">
                                <i class="fas fa-user"></i> Pofile
                            </a>

                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
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