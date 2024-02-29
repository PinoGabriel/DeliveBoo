@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Lista degli Ordini</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Stato</th>
                    <th>Cliente</th>
                    <th>Ristorante</th>
                    <th>Piatti</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->client_name }} {{ $order->client_surname }}</td>
                        <td>{{ $order->restaurant->name }}</td>
                        <td>
                            @foreach ($order->dishes as $dish)
                                {{ $dish->name }} (Quantità: {{ $dish->pivot->quantity }})<br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary">Visualizza Dettagli</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
