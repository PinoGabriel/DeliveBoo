@extends('layouts.admin')

@section('content')
    {{-- <div class="container">
        <h1>Dettagli dell'Ordine</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">ID: {{ $dish->id }}</h5>
                <p class="card-text">Stato: {{ $dish->status }}</p>
                <p class="card-text">Cliente: {{ $dish->client_name }} {{ $dish->client_surname }}</p>
                <p class="card-text">Ristorante: {{ $dish->restaurant->name }}</p>

                <h5 class="mt-4">Piatti nell'Ordine</h5>
                <ul class="list-group">
                    @foreach ($dish->dishes as $dish)
                        <li class="list-group-item">
                            {{ $dish->name }} (Quantità: {{ $dish->pivot->quantity }})
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <a href="{{ route('admin.dishes.index') }}" class="btn btn-secondary mt-3">Torna alla Lista degli Ordini</a>
    </div> --}}

    <div class="container glass my-4">
        <div class="row p-3">
            <div class="col-2">
                <span class="p-2">
                </span>
            </div>
            <div class="col-2">
                <span class="table-btn p-2" onclick="dishByName()">
                    Nome
                    <i id="name-icon" class="fas fa-sort-down ms-1 d-none table-icon"></i>
                </span>
            </div>
            <div class="col-2">
                <span class="table-btn p-2" onclick="dishByVisibility()">
                    Visibilità
                    <i id="visibility-icon" class="fas fa-sort-down ms-1 d-none table-icon"></i>
                </span>
            </div>
            <div class="col-2">
                <span class="table-btn p-2" onclick="dishByPrice()">
                    Prezzo*
                    <i id="price-icon" class="fas fa-sort-down ms-1 d-none table-icon"></i>
                </span>
            </div>
            <div class="col-2">
                <span class="table-btn p-2" onclick="dishByQuantity()">
                    Quantità
                    <i id="quantity-icon" class="fas fa-sort-down ms-1 d-none table-icon"></i>
                </span>
            </div>
            <div class="col-2">
                <span class="table-btn p-2" onclick="dishByTotal()">
                    Totale*
                    <i id="total-icon" class="fas fa-sort-down ms-1 d-none table-icon"></i>
                </span>
            </div>
        </div>

        <div id="table-content" class="d-flex flex-column">
            @foreach ($order->dishes as $dish)
                <div class="dish-btn row{{ $dish->id }}" style="dish: 1;"
                    onclick="window.location='{{ route('admin.dishes.show', $dish->id) }}'">
                    <div class="row dish">
                        <div class="col-2 photo">
                            <span><img class="img-fluid rounded-3"
                                    src="{{ substr($dish->img, 0, 6) == 'upload' ? asset('/storage' . '/' . $dish->img) : $dish->img }}"
                                    alt=""></span>
                        </div>

                        <div class="col-2 name">
                            <span>{{ $dish->name }}</span>
                        </div>

                        <div class="col-2 visibility">
                            <span>{{ $dish->visibility }}</span>
                        </div>

                        <div class="col-2 price">
                            <span>€ {{ $dish->price }}</span>
                        </div>

                        <div class="col-2 quantity">
                            <span>{{ $dish->pivot->quantity }}</span>
                        </div>

                        <div class="col-2 total">
                            <span id="{{ $dish->id }}total"></span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <span id="disclaimer">* i prezzi sono aggiornati allo stato attuale e quindi potrebbero differire dal totale dell'ordine
        in quanto sono
        soggetti a variazione da parte del ristoratore</span>



    <script>
        // get total
        let dishes = {!! json_encode($order->dishes) !!};
        dishes.forEach(dish => {
            let total = 0;
            total += dish.price * dish.pivot.quantity;
            document.getElementById(dish.id + 'total').innerHTML = "€ " + total.toFixed(2);
        });
    </script>



    <style scoped>
        .dish-btn {
            border-radius: 16px;
        }

        .dish-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
            cursor: pointer;
        }

        .dish-btn .row {
            border-bottom: 1px dotted rgba(128, 128, 128, 0.8);
            padding: 1rem;
        }

        .table-btn {
            cursor: pointer;
            border-radius: 12px;
        }

        .table-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .table-btn:hover .d-none {
            display: inline !important;
        }

        #table-content {
            max-height: 50vh;
            overflow-y: auto;
            overflow-x: hidden;
        }

        #disclaimer {
            font-size: 0.8rem;
            position: absolute;
            bottom: 1rem;
        }
    </style>
@endsection
