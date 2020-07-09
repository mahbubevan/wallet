<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/css/user/user.css') }}" rel="stylesheet">
    {{-- login css --}}
    @yield('login-css')
     {{-- font awesome --}}
     <script src="https://kit.fontawesome.com/bda171beb6.js" crossorigin="anonymous"></script>
</head>
<body @yield('body-color')>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white text-uppercase" href="{{ url('/') }}">
                    Wallet <span class="ml-3"><i class="fas fa-wallet"></i></span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                {{-- <span>If you are admin go to </span> --}}
                                <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Admin Login') }}</a>
                            </li>
                            @if (Route::has('user.register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.register') }}">{{ __('User Registration') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="text-success font-weight-bold nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Current Charges  <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class=" disabled  dropdown-item" href="#">
                                 {{ __('Current Currency') }} <span class="font-weight-bold text-info">{{$cr?? ''}}</span>
                                </a>
                                <a class=" disabled  dropdown-item" href="#">
                                    {{ __('Fixed charges') }} <span class="font-weight-bold text-info">{{$fx?? ''}} {{$cr??''}}</span>
                                   </a>
                                   <a class=" disabled  dropdown-item" href="#">
                                    {{ __('Percent charges') }} <span class="font-weight-bold text-info">{{$pc?? ''}}(%)</span>
                                   </a>
                                   <a class=" disabled  dropdown-item" href="#">
                                    {{ __('Signup Reference Bonus') }} <span class="font-weight-bold text-info">{{$osrb?? ''}}{{$cr??''}}</span>
                                   </a>
                                   <a class=" disabled  dropdown-item" href="#">
                                    {{ __('Money Send Reference Bonus') }} <span class="font-weight-bold text-info">{{$omsb?? ''}}(%)</span>
                                   </a>
                                   <a class=" disabled  dropdown-item" href="#">
                                    {{ __('Sign up bonus') }} <span class="font-weight-bold text-info">{{$osb?? ''}} {{$cr??''}} </span>
                                   </a>
                            </div>
                        </li>
                            <li class="nav-item">
                                {{-- <span>If you are admin go to </span> --}}
                                <a class="text-primary nav-link" href="{{ route('user.profile') }}">{{ __('Profile') }} <span class="ml-2"><i class="fas fa-male"></i></span> </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="text-success font-weight-bold nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="ml-2"><i class="far fa-user"></i></span> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="text-danger font-weight-bold dropdown-item" href="{{ route('user.logout') }}"
                                       {{-- onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> --}}>
                                        {{ __('Logout') }} <span class="ml-2"><i class="fas fa-sign-out-alt"></i></span>
                                    </a>

                                    {{-- <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form> --}}
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="mt-3">
                
            </div>
            @yield('content')
        </main>
    </div>
</body>
</html>
