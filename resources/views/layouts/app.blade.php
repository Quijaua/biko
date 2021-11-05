<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.maskMoney.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.cpf-validate.1.0.min.js') }}" defer></script>
    <script src="{{ asset('js/select2.min.js') }}" defer></script>
    <script src="{{ asset('js/quill.min.js') }}" defer></script>
    <script src="{{ asset('js/functions.js') }}" defer></script>

    <!-- FontsAwesome -->
    <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet"> <!--load all styles -->
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet"> <!--load all styles -->
    <link href="{{ asset('css/quill.snow.css') }}" rel="stylesheet"> <!--load all styles -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        @auth
                            @if(Session::get('role') === 'aluno')
                                @if(Session::get('cpf') === 'OK')
                                    <li class="nav-item">
                                        <a class="nav-link" href="/alunos">
                                            {{ __('MEUS DADOS') }}
                                        </a>
                                    </li>
                                @endif
                                @if(Session::get('cpf') === 'null')
                                    <li class="nav-item">
                                        <a class="nav-link btn-danger text-light" href="/alunos">
                                            {{ __('INFORME SEUS DADOS') }}
                                        </a>
                                    </li>
                                @endif
                            @endif

                            @if(Session::get('role') !== 'aluno')
                                @if(Session::get('verified'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="/alunos">{{ __('ALUNOS') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/professores">{{ __('PROFESSORES') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/coordenadores">{{ __('COORDENADORES') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/nucleos">{{ __('NÚCLEOS') }}</a>
                                    </li>
                                @endif
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('nucleo/presences') }}">{{ __('LISTA DE PRESENÇA') }}</a>
                                    </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('messages.index') }}">{{ __('MENSAGENS') }}</a>
                            </li>
                      @endauth
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastro') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                    <span class="badge badge-info text-light p-1">{{ Auth::user()->role }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        @yield('js')
    </div>
</body>
</html>
