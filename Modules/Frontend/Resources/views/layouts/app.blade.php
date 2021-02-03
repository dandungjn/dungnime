<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Anime Template">
        <meta name="keywords" content="Anime, unica, creative, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>DUNGNIME</title>

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

        <!-- Css Styles -->
        <link rel="stylesheet" href="/Modules/Frontend/Resources/js/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="/Modules/Frontend/Resources/js/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="/Modules/Frontend/Resources/js/css/elegant-icons.css" type="text/css">
        <link rel="stylesheet" href="/Modules/Frontend/Resources/js/css/plyr.css" type="text/css">
        <link rel="stylesheet" href="/Modules/Frontend/Resources/js/css/nice-select.css" type="text/css">
        <link rel="stylesheet" href="/Modules/Frontend/Resources/js/css/owl.carousel.min.css" type="text/css">
        <link rel="stylesheet" href="/Modules/Frontend/Resources/js/css/slicknav.min.css" type="text/css">
        <link rel="stylesheet" href="/Modules/Frontend/Resources/js/css/style.css" type="text/css">
    </head>

    <body>
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>
        <!-- Page Preloder End -->

        <!-- Header Section Begin -->
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="header__logo">
                            <a href="{{ route('frontend.home') }}">
                                @if(Request::segment(2) == '')
                                    <img src="/Modules/Frontend/Resources/js/img/logo.png" alt="">
                                @else
                                    <img src="../Modules/Frontend/Resources/js/img/logo.png" alt="">
                                @endif
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="header__nav">
                            <nav class="header__menu mobile-menu">
                                <ul>
                                    <li class="{{Request::is('/') ? 'active' : ''}}"><a href="{{ route('frontend.home') }}">Home</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="header__right">
                            <a href="#" class="search-switch"><span class="icon_search"></span></a>
                        </div>
                    </div>
                </div>
                <div id="mobile-menu-wrap"></div>
            </div>
        </header>
        <!-- Header Section End -->

        <!-- Content Begin -->
            @yield('content')
        <!-- Content End -->

        <!-- Search model Begin -->
        <div class="search-model">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="search-close-switch"><i class="icon_close"></i></div>
                <form class="search-model-form">
                    <input type="text" id="search-input" placeholder="Search here.....">
                </form>
            </div>
        </div>
        <!-- Search model end -->

        <!-- Footer Begin -->
        <footer class="footer">
            <div class="page-up">
                <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="footer__logo">
                            <a href="{{ route('frontend.home') }}"><img src="/Modules/Frontend/Resources/js/img/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="footer__nav">
                            <ul>
                                <li class="active"><a href="{{route('frontend.home')}}">Homepage</a></li>
                            </ul>
                        </div>
                    </div>
              </div>
            </div>
        </footer>
        <!-- Footer end -->
    </body>

    <!-- Js Plugins -->
    <script src="/Modules/Frontend/Resources/js/js/jquery-3.3.1.min.js"></script>
    <script src="/Modules/Frontend/Resources/js/js/bootstrap.min.js"></script>
    <script src="/Modules/Frontend/Resources/js/js/player.js"></script>
    <script src="/Modules/Frontend/Resources/js/js/jquery.nice-select.min.js"></script>
    <script src="/Modules/Frontend/Resources/js/js/mixitup.min.js"></script>
    <script src="/Modules/Frontend/Resources/js/js/jquery.slicknav.js"></script>
    <script src="/Modules/Frontend/Resources/js/js/owl.carousel.min.js"></script>
    <script src="/Modules/Frontend/Resources/js/js/main.js"></script>
    <!-- Js Plugins End -->

</html>