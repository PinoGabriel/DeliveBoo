@php
    $user = auth()->user();
    $hasRestaurant = $user->restaurant !== null;

    $orders = App\Models\Order::with(['restaurant', 'dishes'])->whereHas('restaurant', function ($query) use ($user) {
        $query->where('id', $user->restaurant->id);
    });
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

        <div class="vh-100">
            <div class="h-100">
                <nav id="sidebarMenu" class="d-md-block bg-dark navbar-dark sidebar collapse position-fixed h-100">
                    <div class="position-sticky py-5 h-100">
                        <ul class="nav flex-column h-100 position-relative">

                            <li class="nav-item my-1">
                                <a class="nav-link text-white d-flex align-items-center justify-content-center flex-column"
                                    href="/">
                                    <div class="nav-link-icon">
                                        <i class="fa-solid fa-home-alt fa-lg fa-fw"></i>
                                    </div>
                                    <div class="mt-1 text-center">
                                        Home
                                    </div>
                                </a>
                            </li>

                            @if ($hasRestaurant)
                                <!-- Mostra il pulsante solo se c'è un ristorante -->
                                <li class="nav-item my-1">
                                    <a class="nav-link text-white d-flex align-items-center justify-content-center flex-column"
                                        href="{{ route('admin.restaurants.show', $user->restaurant) }}">
                                        <div
                                            class="nav-link-icon {{ Route::currentRouteName() == 'admin.restaurants.show' ? 'bg-secondary' : '' }}">
                                            <i class="fa-solid fas fa-utensils fa-lg fa-fw"></i>
                                        </div>
                                        <div class="mt-1 text-center">
                                            Ristorante
                                        </div>
                                    </a>
                                </li>

                                <!-- Mostra il pulsante solo se c'è almeno un ordine per il ristorante -->
                                @if ($orders->count() > 0)
                                    <li class="nav-item my-1">
                                        <a class="nav-link text-white d-flex align-items-center justify-content-center flex-column"
                                            href="{{ route('admin.orders.index') }}">
                                            <div
                                                class="nav-link-icon  {{ Route::currentRouteName() == 'admin.orders.index' ? 'bg-secondary' : '' }}">
                                                <i class="fa-solid fa-clipboard-list fa-lg fa-fw"></i>
                                            </div>
                                            <div class="mt-1 text-center">
                                                Ordini
                                            </div>
                                        </a>
                                    </li>
                                @endif
                            @endif

                            @if (!$hasRestaurant)
                                <li class="nav-item my-1">
                                    <a class="nav-link text-white d-flex align-items-center justify-content-center flex-column"
                                        href="{{ route('admin.restaurants.create') }}">
                                        <div
                                            class="nav-link-icon {{ Route::currentRouteName() == 'admin.restaurants.create' ? 'bg-secondary' : '' }}">
                                            <i class="fa-solid fas fa-plus fa-lg fa-fw"></i>
                                        </div>
                                        <div class="mt-1 text-center">
                                            Crea un ristorante
                                        </div>
                                    </a>
                                </li>
                            @endif

                            @if ($hasRestaurant)
                                <li class="nav-item my-1">
                                    <a class="nav-link text-white d-flex align-items-center justify-content-center flex-column"
                                        href="{{ route('admin.dishes.create') }}">
                                        <div
                                            class="nav-link-icon {{ Route::currentRouteName() == 'admin.dishes.create' ? 'bg-secondary' : '' }}">
                                            <i class="fa-solid fas fa-plus fa-lg fa-fw"></i>
                                        </div>
                                        <div class="mt-1 text-center">
                                            Aggiungi un piatto
                                        </div>
                                    </a>
                                </li>
                            @endif

                            <li class="nav-item my-1 position-absolute w-100 bottom-0">
                                <a class="nav-link text-white d-flex align-items-center justify-content-center flex-column"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <div class="nav-link-icon">
                                        <i class="fa-solid fa-sign-out-alt fa-lg fa-fw"></i>
                                    </div>
                                    <div class="mt-1 text-center">
                                        {{ __('Logout') }}
                                    </div>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                        </ul>

                    </div>
                </nav>

                <main class="">
                    <div id="body-content" class="px-4 w-sm-100 position-sm-static admin">
                        @yield('content')

                    </div>
                </main>
            </div>
        </div>

    </div>
</body>

</html>
