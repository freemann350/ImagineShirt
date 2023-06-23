<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ImagineShirt</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Favicon -->
    <link href="{{ url('img/favicon.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ url('js/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ url('css/style.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <a class="logo" id="logo" href="{{ route('home') }}">
            <img src="/img/logo.png" alt="imagineshirt logo">
        </a>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categorias</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 2;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: auto">
                        @foreach ($categories = \App\Models\Category::all() as $category)
                            <a href="{{route('catalog')}}?category={{$category->id}}" class="nav-item nav-link">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('catalog') }}" class="nav-item nav-link">Catálogo</a>
                            <a href="{{ route('cart') }}" class="nav-item nav-link"><i class="fa-solid fa-cart-shopping" style="color: #f03c3c;"></i> Carrinho</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile', Auth::user()) }}">Perfil</a>
                                    <a class="dropdown-item" href="{{ route('orders', Auth::user()) }}">Encomendas</a>
                                    <a class="dropdown-item" href="{{ route('upload', Auth::user()) }}">Imagens próprias</a>
                                    <a class="dropdown-item" href="{{ route('mgmt.home')}}">Dashboard</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        </div>
                    </div>
                </nav>
                @yield('content')
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('js/easing/easing.min.js') }}"></script>
    <script src="{{ url('js/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ url('js/main.js') }}"></script>
</body>

</html>