@php
    $user = auth()->user();
    $hasRestaurant = $user->restaurant !== null;
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        <div class="container-fluid vh-100">
            <div class="row h-100">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark navbar-dark sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">

                            <li class="nav-item">
                                <a class="nav-link text-white" href="/">
                                    <i class="fa-solid fa-home-alt fa-lg fa-fw"></i> Home
                                </a>
                            </li>

                            @if ($hasRestaurant)
                                <!-- Mostra il pulsante solo se c'è un ristorante -->
                                <li class="nav-item">
                                    <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.restaurants.show' ? 'bg-secondary' : '' }}"
                                        href="{{ route('admin.restaurants.show', $user->restaurant) }}">
                                        <i class="fa-solid fas fa-building fa-lg fa-fw"></i> Ristorante
                                    </a>
                                </li>

                                <!-- Mostra il pulsante solo se c'è almeno un ordine per il ristorante -->
                                {{-- @if ($user->restaurant->orders->count() > 0) --}}
                                <li class="nav-item">
                                    <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.orders.index' ? 'bg-secondary' : '' }}"
                                        href="{{ route('admin.orders.index') }}">
                                        <i class="fa-solid fa-clipboard-list fa-lg fa-fw"></i> Lista degli ordini
                                    </a>
                                </li>
                                {{-- @endif --}}
                            @endif

                            @if (!$hasRestaurant)
                                <li class="nav-item">
                                    <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.restaurants.create' ? 'bg-secondary' : '' }}"
                                        href="{{ route('admin.restaurants.create') }}">
                                        <i class="fa-solid fas fa-utensils fa-lg fa-fw"></i> Crea un ristorante
                                    </a>
                                </li>
                            @endif

                            @if ($hasRestaurant)
                                <li class="nav-item">
                                    <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.dishes.create' ? 'bg-secondary' : '' }}"
                                        href="{{ route('admin.dishes.create') }}">
                                        <i class="fa-solid fas fa-plate-wheat fa-lg fa-fw"></i> Aggiungi un piatto
                                    </a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-sign-out-alt fa-lg fa-fw"></i> {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                        </ul>

                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>

    </div>
</body>

</html>
