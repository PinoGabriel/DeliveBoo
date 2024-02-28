@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center p-5 mb-4 rounded-3">
        <div class="container py-5">
            <div class="logo_laravel">
                <img src="{{ asset('img/Logo2.svg') }}" alt="">
            </div>
            <h1 class="display-5 fw-bold">
                BENVENUTO SU DELIVEBOO
            </h1>

            @guest
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg" type="button">{{ __('Login') }}</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg" type="button">{{ __('Register') }}</a>
                @endif
            @else
                @if ($user && $user->restaurant)
                    <a href="{{ route('admin.restaurants.show', ['restaurant' => $user->restaurant->id]) }}"
                        class="btn btn-primary btn-lg" type="button">Il Mio
                        Ristorante</a>
                @else
                    <a href="{{ route('admin.restaurants.create') }}" class="btn btn-primary btn-lg" type="button">Crea il Tuo
                        Ristorante</a>
                @endif
            @endguest
        </div>
    </div>

    <div class="content">
        <div class="container">

        </div>
    </div>
@endsection
