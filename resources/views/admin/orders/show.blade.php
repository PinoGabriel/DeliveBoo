@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Dettagli dell'Ordine</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">ID: {{ $order->id }}</h5>
                <p class="card-text">Stato: {{ $order->status }}</p>
                <p class="card-text">Cliente: {{ $order->client_name }} {{ $order->client_surname }}</p>
                <p class="card-text">Ristorante: {{ $order->restaurant->name }}</p>

                <h5 class="mt-4">Piatti nell'Ordine</h5>
                <ul class="list-group">
                    @foreach($order->dishes as $dish)
                        <li class="list-group-item">
                            {{ $dish->name }} (Quantità: {{ $dish->pivot->quantity }})
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">Torna alla Lista degli Ordini</a>
    </div>
@endsection