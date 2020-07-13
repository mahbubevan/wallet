<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('page-title') </title>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    @stack('jquery')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- font awesome --}}
    <script src="https://kit.fontawesome.com/bda171beb6.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('assets/css/admin/admin.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
                    <ul class="navbar-nav nav-tabs ml-auto">
                        <!-- Authentication Links -->
                        @if(!auth()->guard('admin')->user())
                            <li class="nav-item">

                                <a class="nav-link" href="{{ route('user.login') }}">{{ __('User Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-info {{ Request::is('admin/give_bonus') ? 'active' : '' }} " href="{{route('admin.give.bonus')}}"><i class="fas fa-money-check"></i>  Give Bonus To All User</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link text-success  {{ Request::is('admin/add_new_currency') ? 'active' : '' }} " href="{{route('admin.add.currency')}}"> <i class="fas fa-plus-circle"></i> Add New Currency</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-danger  {{ Request::is('admin/settings') ? 'active' : '' }} " href="{{route('admin.setting')}}"> <i class="fas fa-cogs"></i> Settings</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if(auth()->guard('admin')->user()->username) <span class="text-primary">{{auth()->guard('admin')->user()->username}}<span class="ml-2"><i class="fas fa-users-cog"></i></span> </span> @endif<span class="caret"></span> 
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-danger font-weight-bold" href="{{ route('admin.logout') }}"
                                       {{-- onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> --}}>
                                        {{ __('Logout') }} <span class="ml-2"><i class="fas fa-sign-out-alt"></i></span>
                                    </a>

                                    {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form> --}}
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(auth()->guard('admin')->user())
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 mt-5 h-100">                     
                        <div class="list-group list-group-flush shadow-lg mt-3 mb-5 bg-white rounded">
                            <a href="{{route('admin.dashboard')}}" class="btn list-group-item list-group-item-action {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                                
                              <div class="row">
                                <div class="col-md-10">Dahsboard</div>
                                <div class="col-md-2"><i class="fas fa-columns"></i>
                                </div>
                            </div>
                            </a>
                            <a class="btn list-group-item list-group-item-action {{ Request::is('admin/userlist') ? 'active' : '' }}"
                                href="{{route('admin.userlist')}}"
                            >
                                <div class="row">
                                    <div class="col-md-10">Users</div>
                                    <div class="col-md-2"><i class="fas fa-users"></i></div>
                                </div>
                            </a>
                            <a
                            href="{{route('admin.transaction')}}"
                            class="list-group-item list-group-item-action {{ Request::is('admin/transaction') ? 'active' : '' }}">
                                <div class="row">
                                    <div class="col-md-10">Transactions</div>
                                    <div class="col-md-2"><i class="fas fa-money-check-alt"></i></i></div>
                                </div>
                            </a>
                            {{-- <a
                            href="{{route('admin.ref.transaction')}}"  
                            class="list-group-item list-group-item-action  {{ Request::is('admin/ref_transaction') ? 'active' : '' }}">
                                <div class="row">
                                    <div class="col-md-10">Referral Transaction Log</div>
                                    <div class="col-md-2"><i class="far fa-money-bill-alt"></i></div>
                                </div>
                            </a> --}}
                            <a
                            href="{{route('admin.admin.transaction')}}" 
                            class="list-group-item list-group-item-action  {{ Request::is('admin/admin_transaction') ? 'active' : '' }}">
                                <div class="row">
                                    <div class="col-md-10">Bonus From System</div>
                                    <div class="col-md-2"><i class="fas fa-gifts"></i></div>
                                </div>
                            </a>
                            <a
                            href="{{route('admin.search')}}" 
                            class="list-group-item list-group-item-action  {{ Request::is('admin/search') ? 'active' : '' }}">
                                <div class="row">
                                    <div class="col-md-10">Seach</div>
                                    <div class="col-md-2"><i class="fas fa-search"></i></div>
                                </div>
                            </a>
                            <a
                            href="{{route('admin.check.emails')}}" 
                            class="list-group-item list-group-item-action  {{ Request::is('admin/emails') ? 'active' : '' }}">
                                <div class="row">
                                    
                                    <div class="col-md-10">Email <span class="ml-5 text-danger"> @if ($email_count>0)
                                        <span class="text-danger">{{$email_count}}</span>
                                        @else <span class="text-success">{{$email_count}}</span>
                                    @endif </span> </div>
                                    <div class="col-md-2"><i class="fas fa-envelope-open"></i></div>
                                </div>
                            </a>
                            <a
                            href="{{route('admin.notification')}}" 
                            class="list-group-item list-group-item-action  {{ Request::is('admin/notification') ? 'active' : '' }}">
                                <div class="row">
                                    <div class="col-md-10">Notification <span class="ml-3 text-danger"> @if ($count>0)
                                        <span class="text-danger">{{$count}}</span>
                                        @else <span class="text-success">{{$count}}</span>
                                    @endif </span> </div>
                                    <div class="col-md-2"><i class="far fa-dot-circle"></i></div>
                                </div>
                            </a>
                            @yield('user-profile')
                          </div>
                         
                    </div>
                   @endif
                        <div class="col">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('sweet.error')
    @include('sweet.errors')
    @include('sweet.success')
</body>
</html>
