<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Wallet System</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            html, body {
                
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: white;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                transition: 1s all;
            }

            .links >a:hover{
                text-decoration: underline;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body class="bg-info text-white">
        <div class="flex-center position-ref full-height">
            @if (Route::has('user.login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('user.home') }}">Profile</a>
                    @else
                        <a href="{{ route('user.login') }}">Login</a>

                        @if (Route::has('user.register'))
                            <a href="{{ route('user.register') }}">Register</a>
                        @endif
                    @endauth
                    @if(!auth()->guard('admin')->user())
                        <a href="{{ route('admin.login') }}">Admin Login</a>
                    @else
                        <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                    @endif
                </div>
            @endif
            <div class="content">
                <div class="title m-b-md">
                    My Wallet
                </div>
            </div>
        </div>
    </body>
</html>
