<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
{{-- css --}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

{{-- fontawesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand mx-4" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                @auth

                <a href="{{route('allReviews')}}" class="nav-link mx-4">All Reviews</a>
                <a class="nav-link mx-4" href="{{route('groups.index')}}">
                    Groups
                 </a>
                <a class="nav-link mx-4" href="{{route('books.index')}} ">
                    Find Books
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <ul class="navbar-nav ms-auto">
                            <form action="{{route('search')}}" style="width: 300px">
                                <input type="search" name="search" placeholder="Enter the title or author..." class="form-control form-control-sm">
                            </form>
                        </ul>
                    </ul>
                    @endauth


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
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
                                    @can('admin')
                                    <a href="{{route('admin.users')}}" class="dropdown-item">
                                        <i class="fa-solid fa-user-gear"></i> Admin
                                    </a>

                                    <hr class="dropdown-divider">
                                    @endcan
                                    <a href="{{route('profiles.show', Auth::user()->id)}}" class="dropdown-item">
                                        <i class="fa-solid fa-circle-user"></i> Profile
                                    </a>
                                     <a href="{{route('books.index')}}" class="dropdown-item">
                                            <i class="fa-solid fa-circle-plus"></i> Add new review
                                    </a>
                                    <a href="{{route('notification')}}
                                    " class="dropdown-item">

                                    @if (Auth::user()->notificationCounts() === 0)
                                    <i class="fa-regular fa-bell"></i> Notifications
                                    @else
                                    <i class="fa-solid fa-bell"></i> Notifications
                                    @endif
                                        @if(Auth::check())
                                            <span class="badge bg-secondary">{{ Auth::user()->notificationCounts() }}  </span>
                                        @endif
                                    </a>
                                    <a href="{{route('messages', Auth::user()->id)}}" class="dropdown-item">
                                        @if (Auth::user()->notificationCounts() === 0)
                                        <i class="fa-regular fa-envelope"></i> Messages
                                        @else
                                        <i class="fa-solid fa-envelope"></i> Messages
                                        @endif                                    
                                    
                                        @if(Auth::check())
                                            <span class="badge bg-secondary">{{ Auth::user()->messagesCounts() }}  </span>
                                        @endif

                                    </a>
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

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    @if (request()->is('admin/*'))
                        <div class="col-6 mb-3">
                            <div class="list-group">
                                <a href="{{route('admin.users')}}" class="list-group-item {{request()->is('admin/users') ? 'active' : ' ' }}">
                                    <i class="fa-solid fa-users"></i> Users <span class="badge bg-secondary">{{$userCount}}</span>
                                </a>
                                <a href="{{route('admin.reviews')}}" class="list-group-item {{request()->is('admin/reviews') ? 'active' : ' ' }}">
                                    <i class="fa-solid fa-newspaper"></i> Reviews <span class="badge bg-secondary">{{$reviewCount}}</span>
                                </a>
                                <a href="{{route('admin.books')}}" class="list-group-item {{request()->is('admin/books') ? 'active' : ' ' }}">
                                    <i class="fa-solid fa-tags"></i> Books <span class="badge bg-secondary">{{$bookCount}}</span>
                                </a>
                            </div>
                        </div>
     
                    @endif

                    <div class="col-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
