<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Página institucional de la Secretaría de Turismo del Estado de Chiapas">
    <meta name="author" content="Secretaría de Turismo del Estado de Chiapas">
    <meta name="generator" content="Secretaría de Turismo">
    <title>@yield('title_page')</title>

    {{-- <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/"> --}}

    <!-- Bootstrap core CSS -->
    <!-- CSS only -->
    <link href="{{asset('assets/assets-bootstrap/bootstrap-general/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- CSS Dashboard -->
    <link href="{{asset('assets/assets-bootstrap/dashboard/css/dashboard.css')}}" rel="stylesheet">
    
    <link rel="icon" type="image/x-icon" href="{{asset('assets/imgs/sectur/favicon_chiapas.png')}}">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>
    @stack('css')
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{route('inicio')}}"><img
                src="{{asset('assets/imgs/sectur/logo_sectur.png')}}" alt="logo-sectur-chiapas"></a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> --}}
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                {{-- <a class="nav-link px-3" href="#">Sign out</a> --}}
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{route('dashboard')}}">
                                <span data-feather="home"></span>
                                Tablero
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file"></span>
                                Paginas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('menus.index')}}">
                                <span data-feather="shopping-cart"></span>
                                Menú
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('usuarios.index')}}">
                                <span data-feather="users"></span>
                                Usuarios
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('title_page')</h1>
                </div>
                <div class="container">
                    <div class="row">
                        @yield('content_page')
                    </div>
                </div>
            </main>
        </div>
    </div>


    {{-- CDN Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    {{-- JS Bootstrap --}}
    <script src="{{asset('assets/assets-bootstrap/bootstrap-general/dist/js/bootstrap.bundle.min.js')}}"></script>

    {{-- JS Dashboard --}}
    <script src="{{asset('assets/assets-bootstrap/dashboard/js/dashboard.js')}}"></script>

    {{-- JS --}}
    @stack('js')
</body>

</html>
