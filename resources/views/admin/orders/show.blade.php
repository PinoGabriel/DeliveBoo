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

    <div class="container my-4">
        <div class="row gap-4">
            <div class="col-md col-12 glass p-3">
                <h1>Dettagli ordine</h1>
                <ul class="fa-ul">
                    <li class="my-3"><span class="fa-li"><i
                                class="fa-solid fa-utensils"></i></span>{{ $order->restaurant->name }}</li>
                    <li class="my-3"><span class="fa-li"><i class="fa-solid fa-circle-info"></i></span>
                        <span
                            class="badge {{ $order->status === 'pending' ? 'text-bg-warning' : ($order->status === 'accepted' ? 'text-bg-success' : 'text-bg-danger') }}">{{ $order->status }}</span>
                    </li>
                    <li class="my-3"><span class="fa-li"><i class="fa-solid fa-coins"></i></span>€
                        {{ number_format($order->total, 2) }}
                    </li>
                </ul>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">Torna alla Lista degli Ordini</a>
            </div>

            <div class="col-md col-12 glass p-3">
                <h1>Dettagli cliente</h1>
                <ul class="fa-ul">
                    <li class="my-3"><span class="fa-li"><i class="fa-solid fa-user"></i></span>{{ $order->client_name }}
                        {{ $order->client_surname }}
                    </li>
                    <li class="my-3"><span class="fa-li"><i class="fa-solid fa-phone"></i></span><a
                            href="tel:{{ $order->client_phone }}">{{ $order->client_phone }}</a>
                    </li>
                    <li class="my-3"><span class="fa-li"><i class="fa-solid fa-envelope"></i></span><a
                            href="mailto:{{ $order->client_mail }}">{{ $order->client_mail }}</a>
                    </li>
                    <li class="my-3"><span class="fa-li"><i
                                class="fa-solid fa-location-dot"></i></span>{{ $order->client_address }}</li>
                </ul>
            </div>

        </div>
    </div>

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
                            <span>
                                @if ($dish->deleted_at)
                                    <i class="fa-solid fa-trash-can"></i>
                                @elseif ($dish->visibility)
                                    <i class="fa-solid fa-eye"></i>
                                @else
                                    <i class="fa-solid fa-eye-slash"></i>
                                @endif
                            </span>
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

        const dishRows = document.querySelectorAll('.dish-btn')
        const tableIcons = document.querySelectorAll('.table-btn .table-icon');
        const nameIcon = document.getElementById('name-icon');
        const visibilityIcon = document.getElementById('visibility-icon');
        const priceIcon = document.getElementById('price-icon');
        const quantityIcon = document.getElementById('quantity-icon');
        const totalIcon = document.getElementById('total-icon');
        let dishId = true;
        let dishName = true;
        let dishVisibility = true;
        let dishPrice = true;
        let dishQuantity = true;
        let dishTotal = true;

        function dishByName() {
            tableIcons.forEach(tableIcon => {
                tableIcon.classList.add('d-none');
            })
            nameIcon.classList.remove('d-none');
            let names = [];
            dishRows.forEach(dishRow => {
                names.push(dishRow.children[0].children[1].children[0].innerHTML);
            })
            names.sort()
            if (dishName) {
                nameIcon.classList.remove('fa-sort-up');
                nameIcon.classList.add('fa-sort-down');

            } else {
                nameIcon.classList.remove('fa-sort-down');
                nameIcon.classList.add('fa-sort-up');
                names.reverse()
            }
            dishRows.forEach(dishRow => {
                dishRow.style.order = names.indexOf(dishRow.children[0].children[1].children[0].innerHTML) +
                    1;
            })
            dishName = !dishName;
        }

        function dishByVisibility() {
            tableIcons.forEach(tableIcon => {
                tableIcon.classList.add('d-none');
            })
            visibilityIcon.classList.remove('d-none');
            if (dishVisibility) {
                visibilityIcon.classList.remove('fa-sort-up');
                visibilityIcon.classList.add('fa-sort-down');
                dishRows.forEach(dishRow => {
                    switch (dishRow.children[0].children[2].children[0].children[0].classList[1]) {
                        case "fa-eye":
                            dishRow.style.order = "1";
                            break;
                        case "fa-eye-slash":
                            dishRow.style.order = "2";
                            break;
                        case "fa-trash-can":
                            dishRow.style.order = "3";
                            break;
                        default:
                            break;
                    }
                })

            } else {
                visibilityIcon.classList.remove('fa-sort-down');
                visibilityIcon.classList.add('fa-sort-up');
                dishRows.forEach(dishRow => {
                    switch (dishRow.children[0].children[2].children[0].children[0].classList[1]) {
                        case "fa-eye":
                            dishRow.style.order = "3";
                            break;
                        case "fa-eye-slash":
                            dishRow.style.order = "2";
                            break;
                        case "fa-trash-can":
                            dishRow.style.order = "1";
                            break;
                        default:
                            break;
                    }
                })
            }

            dishVisibility = !dishVisibility;
        }



        function dishByPrice() {
            tableIcons.forEach(tableIcon => {
                tableIcon.classList.add('d-none');
            })
            priceIcon.classList.remove('d-none');
            let prices = [];
            dishRows.forEach(dishRow => {
                prices.push(dishRow.children[0].children[3].children[0].innerHTML);
            })
            prices.sort()
            if (dishPrice) {
                priceIcon.classList.remove('fa-sort-up');
                priceIcon.classList.add('fa-sort-down');

            } else {
                priceIcon.classList.remove('fa-sort-down');
                priceIcon.classList.add('fa-sort-up');
                prices.reverse()
            }
            dishRows.forEach(dishRow => {
                dishRow.style.order = prices.indexOf(dishRow.children[0].children[3].children[0].innerHTML) +
                    1;
            })
            dishPrice = !dishPrice;
        }




        function dishByQuantity() {
            tableIcons.forEach(tableIcon => {
                tableIcon.classList.add('d-none');
            })
            quantityIcon.classList.remove('d-none');
            let totals = [];
            dishRows.forEach(dishRow => {
                totals.push(dishRow.children[0].children[4].children[0].innerHTML);
            })
            totals.sort((a, b) => a - b)
            if (dishQuantity) {
                quantityIcon.classList.remove('fa-sort-up');
                quantityIcon.classList.add('fa-sort-down');
            } else {
                quantityIcon.classList.remove('fa-sort-down');
                quantityIcon.classList.add('fa-sort-up');
                totals.reverse();
            }
            dishRows.forEach(dishRow => {
                dishRow.style.order = totals.indexOf(dishRow.children[0].children[4].children[0].innerHTML) +
                    1;
            })
            dishQuantity = !dishQuantity
        }




        function dishByTotal() {
            tableIcons.forEach(tableIcon => {
                tableIcon.classList.add('d-none');
            })
            totalIcon.classList.remove('d-none');
            let totals = [];
            dishRows.forEach(dishRow => {
                totals.push(dishRow.children[0].children[5].children[0].innerHTML.substring(2));
            })
            totals.sort((a, b) => a - b)
            if (dishTotal) {
                totalIcon.classList.remove('fa-sort-up');
                totalIcon.classList.add('fa-sort-down');
            } else {
                totalIcon.classList.remove('fa-sort-down');
                totalIcon.classList.add('fa-sort-up');
                totals.reverse();
            }
            dishRows.forEach(dishRow => {
                dishRow.style.order = totals.indexOf(dishRow.children[0].children[5].children[0].innerHTML
                        .substring(2)) +
                    1;
            })
            dishTotal = !dishTotal
        }
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
