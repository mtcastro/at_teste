<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicon32.ico')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Atividade Teste')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    @yield('js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @yield('font')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" rel="stylesheet">
    <!-- Estilos customizados para esse template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    @yield('css')

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light site-navbar navDash fixed-top">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{asset('img/logo.svg')}}" alt="...">
            </a>
            <button class="navbar-toggler" type="button" id="menuDash" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>

        <div class="d-flex" id="nav-lateral" style="margin-top: 90px">
            <nav class="bg-light sidebar sidenav dashDisplay" id="mySidenav">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">

                            <div class="media pb-1 text-center mt-2 pb-2 mb-2 border-bottom">
                                <div class="media-body">
                                    <i class="fas fa-user-circle fa-2x"></i>
                                    <h5 class="mt-0 mb-0 font-weight-normal text-dark">
                                        Matheus Castro</h5>
                                    <p class="mb-0 font-weight-light mx-2">matheus.castro.fsa@gmail.com</p>

                                </div>

                            </div>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home')}}">
                                <i class="fas fa-home ds-inc mr-3"></i> Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('logconsultas')}}">
                                <i class="fas fa-clipboard-list mr-3"></i> Log de consultas
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('notificacao')}}">
                                <i class="fas fa-envelope-open-text mr-3"></i> Notificações
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="container px-4 pb-3" id="mainDash">
                
                
                @yield('main-content')

            </main>
        </div>
    </div>
</body>

</html>