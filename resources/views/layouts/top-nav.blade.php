<nav class="main-header navbar navbar-expand-lg navbar-navy navbar-dark sticky-top">
    <div class="container">
        <a href="{{url('/')}}" class="pl-1 pr-0 nav-link">
            <span class="brand-text">
                Beranda
            </span>
        </a>
        <button class="navbar-toggler order-1 ml-2" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fas fa-bars" style="color:#fff; font-size:28px;"></i></span>
        </button>
        <div class="collapse navbar-collapse order-2 ml-2" id="navbarCollapse">
            <ul class="nav navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Galeri</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Berita</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Data Santri</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Data Alumni</a></li>
            </ul>
        </div>
        <ul class="navbar-nav ml-auto order-3 order-md-3 navbar-no-expand">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Masuk Aplikasi') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <a class="dropdown-item" href="{{ url('dashboard') }}">
                        Dashboard
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
</nav>