<!DOCTYPE html>
<html>

<head>
    <title> Albums Sharing </title>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="RoQaY">
    <meta name="robots" content="index, follow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=" Albums Sharing website">
    <meta name="keywords" content=" Albums Sharing ">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/fontawesome.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/responsive.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
    <style>
    body{
        font-family: 'Lalezar', cursive;
      }
    </style>

</head>

<body>
    <div class="body_wrapper">
        <div class="preloader">
            <div class="preloader-loading">
                <img src="{{asset('images/logo-m.png')}}" data-src="{{asset('images/logo-m.png')}}" class="lazyload">
            </div>
        </div>
        <div class="top_nav">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <ul class="d-flex about-site">
                            <li><a href="#">Questions</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Terms Of Privacy</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <ul class="d-flex social ">
                            <li> <a href="#"> <i class="fab fa-facebook-f"></i> </a></li>
                            <li> <a href="#"> <i class="fab fa-twitter"></i> </a></li>
                            <li> <a href="#"> <i class="fab fa-instagram"></i> </a></li>
                            <li> <a href="#"> <i class="fab fa-snapchat-ghost"></i> </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container">
                <a class="navbar-brand" href="/"><img src="{{asset('images/logo-m.png')}}" data-src="{{asset('images/logo-m.png')}}"
                        class="lazyload"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <ul class="menu-bars">
                            <li><span></span></li>
                            <li><span></span></li>
                            <li><span></span></li>
                        </ul>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        @auth
                        <li class="nav-item">
                            <a id="navbarDropdown" class="nav-link" href="/album" role="button">
                                {{ Auth::user()->name }}
                            </a>
                        </li>
                        @endauth
                        @guest
                        <li class="nav-item">
                            <button class="btn btn-gradiant">
                                <a href="/login">login</a>
                            </button>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <section class="check_demo_movie">
            @yield('content')
        </section>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <a class="navbar-brand" href="/"><img src="{{asset('images/logo-m.png')}}"
                                data-src="{{asset('images/logo-m.png')}}" class="lazyload"></a>
                        <p> Interact With The Content In An Interesting Educational Experience, Using Studying Means
                            Anywhere & Anytime Directly From your Computer. </p>
                    </div>
                    <div class="col-md-4">
                        <h5>Links</h5>
                        <div class="links d-flex">
                            <ul>
                                <li> <a href="#"> > Create Account</a></li>
                                <li> <a href="#"> > movie</a></li>
                                <li> <a href="#"> > Team </a></li>
                                <li> <a href="#"> > Company </a></li>
                            </ul>
                            <ul>
                                <li> <a href="#"> > Questions</a></li>
                                <li> <a href="#"> > Blog</a></li>
                                <li> <a href="#"> > Terms of Privacy </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Contact Us</h5>
                        <div><a href="mailto:info@smartmovie.com"> <i class="fas fa-envelope"></i>
                                info@smartmovie.com</a></div>
                        <form action="">
                            <div class="input-group mb-2">
                                <input type="email" class="form-control" id="inlineFormInputGroup"
                                    placeholder=" Your Email ">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <button class="btn btn-gradiant m-0">
                                            <a href="#">Send</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <ul class="d-flex social ">
                            <li> <a href="#"> <i class="fab fa-facebook-f"></i> </a></li>
                            <li> <a href="#"> <i class="fab fa-twitter"></i> </a></li>
                            <li> <a href="#"> <i class="fab fa-instagram"></i> </a></li>
                            <li> <a href="#"> <i class="fab fa-snapchat-ghost"></i> </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="copyrights">
                <p>© All Rights reserved to Albums Sharing website 2017</p>
            </div>
        </footer>
        <span class="scroll-top"> <a href="#"><i class="fas fa-chevron-up"></i></a> </span>
    </div>
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/lazysizes.min.js')}}"></script>
    <script src="{{asset('js/fontawesome.min.js')}}"></script>
    <script src="{{asset('js/all.min.js')}}"></script>
    <script src="{{asset('js/wow.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    @yield('js')
</body>

</html>
