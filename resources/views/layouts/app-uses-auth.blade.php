<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Mobile Specific Metas
        ================================================== -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="site test App">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,">
        <meta name="author" content="{{ config('app.name') }}">

        <!-- ** Plugins Needed for the Project ** -->
        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{asset('plugins/bootstrap/bootstrap.min.css')}}">

        <!-- animation css -->
        <link rel="stylesheet" href="{{asset('plugins/animate/animate.css')}}">

        <!-- Font awesomes scripts -->
        <link href="{{asset('plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">

        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/star.png')}}">

        <!-- Custom Stylesheet -->
        <link rel="stylesheet" href="{{asset('css/style.css')}}">

        @yield("app_head")
    </head>

    <body>
        <div class="preloader"></div>
        <header>
            <div class=container>
                <div class=row>
                    <div class="col-xs-12">
                        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
                            <!-- Brand -->
                            <a class="navbar-brand" href="#">{{ config("app.name") }}</a>

                            @if(auth()->user()->role !== "admin")
                                <p class=cart>
                                    <a href="{{ auth()->user() ? route('account.cart') : route('login') }}">
                                        <span class="fa fa-shopping-cart text-white">
                                            <span class="badge badge-danger" id=cart-items-count>{{ $carts->where("user_id", auth()->user()->id)->sum('quantity') ?? 0 }}</span>
                                            <br>cart
                                        </span>
                                    </a>
                                </p>
                            @endif

                            <!-- Toggler/collapsibe Button -->
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <!-- Navbar links -->
                            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.dashboard') }}"><span class="fas fa-book"></span> Dashboard</a>
                                    </li>
                                    @if(auth()->user()->role == "admin")
                                        <!-- Dropdown -->
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                            <span class="fas fa-edit"></span> Create
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.create.category') }}">Category</a>
                                                <a class="dropdown-item" href="{{ route('admin.create.product') }}">Product</a>
                                            </div>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.view.products') }}"><span class="fa fa-dashboard"></span> Products</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.view.categories') }}"><span class="fa fa-dashboard"></span> Categories</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.view.users.cart') }}"><span class="fa fa-shopping-cart"></span> Carts</a>
                                        </li>
                                    @endif
                                </ul>

                                <div class="login-box" >
                                    <a class="btn btn-md btn-info"href="#" onclick="event.preventDefault(); $('#logoutForm').submit();"><span class="fa fa-lock"></span> Logout</a>
                                    <form id=logoutForm action="{{ route('logout') }}" method=post>
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <section class="section-user-info offset-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-lg-2 col-sm-3 col-xs-6 md-mb25">
                        <h5><span class="fa fa-heart"></span> Welcome </h5>
                        <ul>
                            <li><a href="#">Portal: {{ auth()->user()->role }}: {{ auth()->user()->email }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        @yield("app_section")

        
        <!-- footer wrapper -->
        <div class="footer-wrapper bg-dark text-white mt-5 pt-5">
            <div class="container">
                <div class="row">
                    @guest
                        <div class="col-sm-12">
                            <div class="row">
                                
                                <div class="col-md-3 col-lg-2 col-sm-3 col-xs-6 md-mb25">
                                    <h5><span class="fa fa-globe"></span> Language</h5>
                                    <ul>
                                        <li><a href="#">English</a></li>
                                    </ul>
                                </div>
                                
                                <div class="col-md-3 col-lg-2 col-sm-4 col-xs-6">
                                    <h5><span class="fa fa-heart"></span> More</h5>
                                    <ul>
                                        <li><a href="#">FAQ</a></li>
                                        <li><a href="#">Term of use</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-3 col-lg-2 col-sm-4 col-xs-6">
                                    <h5 class="mb-3"><span class="fa fa-anchor"></span> Office</h5>
                                    <p style="width: 100%;">{{ config("globals.company_address") }}</p>
                                </div>
                            </div>
                            <div class="middle-footer mt-5 pt-4"></div>
                        </div>
                    @endguest

                    <div class="col-sm-12 lower-footer pt-0"></div>

                    <div class="col-sm-6 col-xs-12">
                        <p class="copyright-text">&copy; {{ date("Y") }} copyright {{ config("globals.site_full_name") }}. All rights reserved.</p>
                    </div>
                    <div class="col-sm-6 col-xs-12 text-right">
                        <p class="copyright-text float-right">Design by <a href="#" class="">Mr Emmanuel Onwukwe</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer wrapper -->
    

        <!-- jQuery -->
        <script src="{{asset('plugins/jQuery/jquery.min.js')}}"></script>
        <!-- Bootstrap JS -->
        <script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}"></script>

        <script src="{{ asset('js/scripts.js') }}"></script>
        @yield("app_tail")
    </body>
</html>

