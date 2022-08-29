<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" /> --}}
    <link href="{{asset('assets/assets-bootstrap/bootstrap-general/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    
    <link rel="icon" type="image/x-icon" href="{{asset('assets/imgs/sectur/favicon_chiapas.png')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <title>
        Secretaría de Turismo del Estado de Chiapas
    </title>
    <meta name="description" content="Multi level hover dropdown Navbar for bootstrap 4 and bootstrap 5" />
    <meta name="keywords" content="Multi level hover dropdown Navbar for bootstrap 4 and bootstrap 5" />

    <style>
        .dropdown-menu {
            margin-top: 0;
        }

        .dropdown-menu .dropdown-toggle::after {
            vertical-align: middle;
            border-left: 4px solid;
            border-bottom: 4px solid transparent;
            border-top: 4px solid transparent;
        }

        .dropdown-menu .dropdown .dropdown-menu {
            left: 100%;
            top: 0%;
            margin: 0 20px;
            border-width: 0;
        }

        .dropdown-menu .dropdown .dropdown-menu.left {
            right: 100%;
            left: auto;
        }

        @media (min-width: 768px) {
            .dropdown-menu .dropdown .dropdown-menu {
                margin: 0;
                border-width: 1px;
            }

            .dropdown-menu>li a:hover,
            .dropdown-menu>li.show {
                background: #007bff;
                color: white;
            }

            .dropdown-menu>li.show>a {
                color: white;
            }
        }

    </style>

    <style>
        .fot{
            position: absolute;
  bottom: 0;
  width: 100%;
  height: 60px; /* Set the fixed height of the footer here */
  line-height: 60px; /* Vertically center the text there */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="main_navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('inicio')}}"><img
                src="{{asset('assets/imgs/sectur/logo_sectur.png')}}" alt="logo-sectur-chiapas"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @foreach ($menus as $key => $item)
                        @if ($item['parent'] != 0)
                            @break
                        @endif
                        @include('shared.navbar', ['item' => $item])
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="alert alert-info">
            <a href="#">
                How to use bootNavbar
            </a>
        </div>
    </div>
    <div class="container mt-5">
        <div class="alert alert-info">
            <a href="#">
                How to use bootNavbar
            </a>
        </div>
    </div>
    <div class="container mt-5">
        <div class="alert alert-info">
            <a href="#">
                How to use bootNavbar
            </a>
        </div>
    </div>

        <!-- Footer -->
    @include('layouts.footer')
        <!-- Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function bootnavbar(options) {
            const defaultOption = {
                selector: "main_navbar",
                animation: true,
                animateIn: "animate__fadeIn",
            };

            const bnOptions = {
                ...defaultOption,
                ...options
            };

            init = function () {
                var dropdowns = document
                    .getElementById(bnOptions.selector)
                    .getElementsByClassName("dropdown");

                Array.prototype.forEach.call(dropdowns, (item) => {
                    //add animation
                    if (bnOptions.animation) {
                        const element = item.querySelector(".dropdown-menu");
                        element.classList.add("animate__animated");
                        element.classList.add(bnOptions.animateIn);
                    }

                    //hover effects
                    item.addEventListener("mouseover", function () {
                        this.classList.add("show");
                        const element = this.querySelector(".dropdown-menu");
                        element.classList.add("show");
                    });

                    item.addEventListener("mouseout", function () {
                        this.classList.remove("show");
                        const element = this.querySelector(".dropdown-menu");
                        element.classList.remove("show");
                    });
                });
            };

            init();
        }

    </script>
    <script>
        new bootnavbar();

    </script>
</body>

</html>
