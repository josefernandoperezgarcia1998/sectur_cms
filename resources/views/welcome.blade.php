<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    {{-- Descripcion del website --}}
    <meta name="description" content="Página institucional de la Secretaría de Turismo del Gobierno del Estado de Chiapas" />
    {{-- Palabras clave del website --}}
    <meta name="keywords" content="Página institucional de la Secretaría de Turismo del Gobierno del Estado de Chiapas" />
    {{-- Autor del website --}}
    <meta name="author" content="Gobierno del Estado de Chiapas">
    {{-- Titulo al comaprtie el enlace  --}}
    <meta property="og:title" content="Secretaría de Turismo">
    {{-- Imagen del website al momento de compartir un enlace ó el enlace general del sitio --}}
    <meta property="og:image" content="{{asset('assets/imgs/sectur/logo_sectur.png')}}">
    {{-- Short name of the website --}}
    <meta property="og:title" content="SECTUR Chiapas"/>
    {{-- Enlace completo al ompartir el website --}}
    <meta property="og:url" content="https://institucional.visitchiapas.com/" />
    {{-- Descripción que va a tener al compartir el website --}}
    <meta property="og:description" content="Página institucional de la Secretaría de Turismo del Gobierno del Estado de Chiapas">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" /> --}}
    {{-- Estilos de boostrap 5 --}}
    <link href="{{asset('assets/assets-bootstrap/bootstrap-general/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    {{-- Icono (favicon) para el website --}}
    <link rel="icon" type="image/x-icon" href="{{asset('assets/imgs/sectur/favicon_chiapas.png')}}">
    {{-- Estilo CSS para la animación del menú de navegación --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    {{-- En dado caso que el CDN del menu de navegación para animate.min.cs no pueda funcionar aquí está el archivo puro (se debe de descomentar) --}}
    {{-- <link rel="stylesheet" href="{{asset('assets/navbar/animate.min.css')}}"> --}}
    <title>
        Secretaría de Turismo del Estado de Chiapas
    </title>
    {{-- Estilos CSS para el menú de navegación --}}
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
        footer {
            position: sticky;
            width: 100%;
        }
    </style>

    {{-- Link de estilos generales para el sistema--}}
    <link rel="stylesheet" href="{{asset('assets/css/estilos.css')}}">
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

    <main class="contenedor-general">
        <div class="container mt-5">
            <div class="alert alert-info">
                <a href="#">
                    How to use bootNavbar
                </a>
            </div>
        </div>
        <div class="container mt-5">
            <h3 class="display-6">Ubicación</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.442215140926!2d-93.08337298558745!3d16.754660525155153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1141cfc8565cf697%3A0xd55baf4cb4d656ed!2sSecretar%C3%ADa%20de%20Turismo%20del%20Gobierno%20de%20Chiapas!5e0!3m2!1ses!2smx!4v1662564573468!5m2!1ses!2smx" style="width: 100%;" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </main>

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
