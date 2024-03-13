<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/public/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/public/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/public/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('/public/slick/slick-theme.css')}}">
    <link rel="icon" href="/public/img/logo-icon.png" type="image/png">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="shortcut icon" href="/public/img/logo-icon.png" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>@yield('title')</title>
</head>
<body>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-16459019663"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    //gtag('config', 'AW-16459019663',{ 'debug_mode': true });
    gtag('config', 'AW-16459019663');
</script>
<nav class="navbar fornav navbar-expand-lg fixed-top bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="/"><img src="/public/img/logo.png" width="48px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <div class="row">
                        <div class="col-auto">
                            <a class="nav-link active" aria-current="page" href="/">
                                <i class="fa fa-home d-md-none fa-sm" aria-hidden="true" style="width:20px"></i>
                            </a>
                        </div>
                        <div class="col">
                            <a class="nav-link active" aria-current="page" href="/">@lang('main.nav_main')</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="row">
                        <div class="col-auto">
                            <a class="nav-link" href="{{ url('/collection') }}">
                                <i class="fa-solid fa-shirt d-md-none fa-sm" style="width:20px"></i>
                            </a>
                        </div>
                        <div class="col">
                            <a class="nav-link" href="{{ url('/collection') }}">@lang('main.nav_collection')</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item d-md-none">
                    <div class="row">
                        <div class="col-auto">
                            <a class="nav-link" href="{{ url('/cart') }}">
                                <i class="fa-solid fa-cart-shopping d-md-none fa-sm" style="width:20px"></i>
                            </a>
                        </div>
                        <div class="col">
                            <a class="nav-link" href="{{ url('/cart') }}">@lang('main.cart')</a>
                        </div>
                    </div>
                </li>
                @guest
                    <li class="nav-item d-md-none">
                        <div class="row">
                            <div class="col-auto">
                                <a class="nav-link" href="{{ url('login') }}">
                                    <i class="fa-solid fa-right-to-bracket d-md-none fa-sm" style="width:20px"></i>
                                </a>
                            </div>
                            <div class="col">
                                <a class="nav-link" href="{{ url('login') }}">@lang('main.log')</a>
                            </div>
                        </div>
                    </li>
                @endguest

                @auth
                    <li class="nav-item d-md-none">
                        <div class="row">
                            <div class="col-auto">
                                <a class="nav-link" href="{{ url('profile') }}">
                                    <i class="fa-solid fa-user d-md-none fa-sm" style="width:20px"></i>
                                </a>
                            </div>
                            <div class="col">
                                <a class="nav-link" href="{{ url('profile') }}">@lang('main.profile')</a>
                            </div>
                        </div>
                    </li>
                @endauth
                <li class="nav-item d-md-none">
                    <div class="row">
                        <div class="col-auto">
                            <a class="nav-link" aria-current="page" href="{{ route('locale', __('main.set_locale') ) }}">
                                <i class="fa-solid fa-earth-europe d-md-none fa-sm"></i>
                            </a>
                        </div>
                        <div class="col">
                            <a class="nav-link" aria-current="page" href="{{ route('locale', __('main.set_locale') ) }}">
                                &ensp;@lang('main.set_locale') @lang('main.version')
                            </a>
                        </div>
                    </div>
                </li>
            </ul>

        </div>

            <div class=" nav-pc">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-but" id="langSelector">
                        <div class="icon-wrapper">
                            <a class="nav-link" >
                                @lang('main.current_locale')
                            </a>
                            <div class="language-dropdown">
                                <ul style="text-align: center;">
                                    <li><a href="{{ route('locale', __('main.set_locale') ) }}" >@lang('main.set_locale')</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li class="nav-but">
                        <div class="icon-wrapper">
                            <a href="{{ url('cart') }}">
                                <img src="/public/img/icon-bag.png" width="40px">
                            </a>
                        </div>
                    </li>
                    @guest
                        <li class="nav-but">
                            <div class="icon-wrapper">
                                <a href="{{ url('login') }}">
                                    <img src="/public/img/icon-login.png" width="40px">
                                </a>
                            </div>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-but">
                            <div class="icon-wrapper">
                                <a href="{{ url('profile') }}">
                                    <img src="/public/img/profile.png" width="40px">
                                </a>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>




        </div>
    </div>
</nav>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/56d1bbb0b1.js" crossorigin="anonymous"></script>
    @yield('content')

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>@lang('main.footer_protect')</h4>
                <ul class="list-unstyled">
                    <li><a href="{{ url('delivery') }}">@lang('main.delivery')</a></li>
                    <li><a href="{{ url('payment') }}">@lang('main.payment')</a></li>
                    <li><a href="{{ url('return') }}">@lang('main.return')</a></li>
                    <li><a href="{{ url('sizes') }}">@lang('main.size_tables')</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>@lang('main.footer_info')</h4>
                <ul class="list-unstyled">
                    <li><a href="{{ url('about') }}">@lang('main.section_about')</a></li>
{{--                    <li><a href="">@lang('main.public_offer')</a></li>--}}
                    <li><a href="{{ url('conferent') }}">@lang('main.privacy_policy')</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>@lang('main.footer_account')</h4>
                <ul class="list-unstyled">
                    @guest
                        <li><a href="{{ url('login') }}">@lang('main.sign_in')</a></li>
                        <li><a href="{{ url('register') }}">@lang('main.sign_up')</a></li>
                    @endguest
                    <li><a href="{{ url('cart') }}">@lang('main.bag')</a></li>
                    <li><a href="{{ url('profile') }}">@lang('main.favorite')</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="https://www.instagram.com/anion_clothes/"><img src="https://cdn-icons-png.flaticon.com/512/1384/1384031.png" width="30px"></a></li>

                </ul>
            </div>
            <div class="col-md-6">
                <p class="text-right">© {{ now()->year }} {{ env('APP_NAME') }} All Rights Reserved</p>
            </div>
        </div>
    </div>
</footer>

    <script src="{{asset('/public/js/app.js')}}"></script>
    <script src="{{asset('/public/js/script.js')}}"></script>
    <script src="{{asset('/public/slick/slick.min.js')}}"></script>
    <script>
        function showDropdown() {
            document.getElementById("dropdown-content").style.display = "block";
        }

        function hideDropdown() {
            document.getElementById("dropdown-content").style.display = "none";
        }

    </script>




</body>
</html>
