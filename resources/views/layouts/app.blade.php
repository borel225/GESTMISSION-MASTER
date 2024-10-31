<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gestmission-master') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">

        @auth
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo gestmission.png') }}" alt="Logo" style="height: 50px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('Paramètres') }}
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{ route('users.index') }}">Liste utilisateurs</a></li>
                              <li><a class="dropdown-item" href="{{ route('roles.documentation') }}">Documentations</a></li>
                              <li><a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a></li>
                              <li><a class="dropdown-item" href="{{ route('permissions.index') }}">Permissions</a></li>
                              <li><a class="dropdown-item" href="{{ route('parametre_perdiems.index') }}">Parametre Perdiem</a></li>
                            </ul>
                          </li>


                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('Utilitaires') }}
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{ route('fonctions.index') }}">Fonctions</a></li>
                              <li><a class="dropdown-item" href="{{ route('directions.index') }}">Directions</a></li>
                              <li><a class="dropdown-item" href="{{ route('services.index') }}">Services</a></li>
                              <li><a class="dropdown-item" href="{{ route('lieus.index') }}">Lieux</a></li>
                              <li><a class="dropdown-item" href="{{ route('agents.index') }}">Agents</a></li>
                              <li><a class="dropdown-item" href="{{ route('categorie_agent.index') }}">Catégories Agent</a></li>
                              <li><a class="dropdown-item" href="{{ route('type_missions.index') }}">Type de missions</a></li>
                            </ul>
                          </li>

                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('Missions') }}
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{ route('missions.create') }}">Créer une mission</a></li>
                              <li><a class="dropdown-item" href="{{ route('missions.index') }}">Liste des missions </a></li>
                              <li><a class="dropdown-item" href="{{ route('ordre_missions.index') }}">Mes missions</a></li>
                              <li><a class="dropdown-item" href="{{ route('ordreMission') }}">Ordre de mission</a></li>
                            </ul>
                          </li>

                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('Validations') }}
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{ route('ordre_missions.validations')}}">Mes validations de missions</a></li>
                              <li><a class="dropdown-item" href="{{ route('ordre_missions.evaluations') }}">Validation Cellule Mission</a></li>
                              <li><a class="dropdown-item" href="{{ route('evalutionDFC')}}">Validation DFC </a></li>
                            </ul>
                          </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
                    </ul>
                </div>
            </div>
        </nav>
        @endauth
        <main class="py-4">
            <div class="container">
                        @if (session('success'))
                    <div class="alert alert-success ">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>


        @yield('content')


        </main>
        @include('script')
    </div>
</body>
</html>
