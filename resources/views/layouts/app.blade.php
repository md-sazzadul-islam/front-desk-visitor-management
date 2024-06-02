<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('uploads/' . get_title('app_fav')) }}" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ get_title('app_name') . ' - ' . get_title('app_title') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app" class="page-container">
        @guest
        @else
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    {{-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ get_title('app_name') }}
                </a> --}}
                    <a href="{{URL('/')}}">
                        <img src="{{ asset('uploads/' . get_title('app_logo')) }}" alt="{{ get_title('app_name') }}"
                        height="40">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->

                            @can('visitor-not_exit')
                                <li><a class="nav-link {{ request()->is('visitor/not_exit') ? 'active' : '' }}"
                                        href="{{ route('visitor.not_exit') }}">Visitors not exit</a></li>
                            @endcan
                            @can('visitor-today')
                                <li><a class="nav-link {{ request()->is('visitor/today') ? 'active' : '' }}"
                                        href="{{ route('visitor.today') }}">Today's Visitors</a></li>
                            @endcan
                            @can('visitor-list')
                                <li><a class="nav-link {{ request()->is('visitors') ? 'active' : '' }}"
                                        href="{{ route('visitors.index') }}">Visitors List</a></li>
                            @endcan
                            @can('visitor-create')
                                <li><a class="nav-link {{ request()->is('visitors/create') ? 'active' : '' }}"
                                        href="{{ route('visitors.create') }}">Visitor Entry</a></li>
                            @endcan
                            @can('user-list')
                                <li><a class="nav-link {{ request()->is('users*') ? 'active' : '' }}"
                                        href="{{ route('users.index') }}">Manage Users</a></li>
                            @endcan
                            @can('role-list')
                                <li><a class="nav-link {{ request()->is('roles*') ? 'active' : '' }}"
                                        href="{{ route('roles.index') }}">Manage Role</a></li>
                            @endcan


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @can('settings')
                                        <a class="dropdown-item" href="{{ route('settings.index') }}">

                                            Settings
                                        </a>
                                    @endcan
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

                        </ul>
                    </div>
                </div>
            </nav>
        @endguest

        <main class="py-4">
            @include('layouts/flash-message')
            <div class="container content-wrap">
                @yield('content')
            </div>
        </main>
        {{-- footer import --}}
        @include('layouts.footer')
    </div>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
    @yield('myjsfile')
</body>

</html>
