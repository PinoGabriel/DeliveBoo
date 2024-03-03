@extends('layouts.admin')

@section('content')
    <div class="container my-4 glass p-3">
        <div class="row">
            <div class="img-container col-auto">
                <img class="img-fluid rounded-4 w-100"
                    src="{{ substr($dish->img, 0, 6) == 'upload' ? asset('/storage' . '/' . $dish->img) : $dish->img }}"
                    alt="">
            </div>
            <div class="col-auto d-flex flex-column justify-content-between">
                <div class="mt-2">
                    <h1>{{ $dish->name }}</h1>
                    <ul class="fa-ul">
                        <li class="my-3"><span class="fa-li"><i
                                    class="fa-solid fa-utensils"></i></span>{{ $user->restaurant->name }}
                        </li>
                        @if ($dish->visibility)
                            <li class="my-3"><span class="fa-li"><i class="fa-regular fa-eye"></i></span>Visibile nel
                                menù
                            </li>
                        @else
                            <li class="my-3"><span class="fa-li"><i class="fa-regular fa-eye-slash"></i></span>Non
                                visibile nel menù
                            </li>
                        @endif
                        <li class="my-3"><span class="fa-li"><i class="fa-solid fa-user"></i></span>{{ $user->name }}
                        </li>
                        <li class="my-3"><span class="fa-li"><i class="fa-solid fa-coins"></i></span>€
                            {{ number_format($dish->price, 2) }}
                        </li>

                    </ul>
                </div>

                <div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.dishes.index') }}"
                            class="btn btn-primary d-flex justify-content-center align-items-center"><i
                                class="fa-solid fa-utensils me-2 fs-5"></i><span> Mostra tutti i piatti</span></a>
                        <a href="{{ route('admin.dishes.edit', $dish) }}"
                            class="btn btn-warning d-flex justify-content-center align-items-center"><i
                                class="fa-solid fa-pencil fs-5"></i></a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger d-flex justify-content-center align-items-center"
                            data-bs-toggle="modal" data-bs-target="#{{ $dish->id }}">
                            <i class="fa-solid fa-trash-can fs-5"></i>
                        </button>


                    </div>
                </div>
            </div>
        </div>

        <div class="row my-4">
            <div class="my-3 section-title">
                <h2>Descrizione</h1>
            </div>

            <div>
                <p>{{ $dish->description }}</p>
            </div>

        </div>
    </div>

    {{-- charts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="container mb-4">

        <div class="row gap-4">

            <div class="col-12 col-md-6 glass p-4">
                <h3>Ordini contenenti il prodotto</h3>
                {{-- <canvas id="line-chart"></canvas> --}}

                <div>

                    <div class="row p-3">
                        <div class="col">
                            <span class="table-btn p-2" onclick="orderByClient()">
                                Cliente
                                <i id="client-icon" class="fas fa-sort-down ms-1 d-none table-icon"></i>
                            </span>
                        </div>
                        <div class="col">
                            <span class="table-btn p-2" onclick="orderByStatus()">
                                Stato
                                <i id="status-icon" class="fas fa-sort-down ms-1 d-none table-icon"></i>
                            </span>
                        </div>
                        <div class="col">
                            <span class="table-btn p-2" onclick="orderByDate()">
                                Data
                                <i id="date-icon" class="fas fa-sort-down ms-1 d-none table-icon"></i>
                            </span>
                        </div>
                        <div class="col">
                            <span class="table-btn p-2" onclick="orderByTotal()">
                                Totale
                                <i id="total-icon" class="fas fa-sort-down ms-1 d-none table-icon"></i>
                            </span>
                        </div>
                    </div>

                    <div id="table-content" class="d-flex flex-column">
                        @foreach ($orders as $order)
                            @if ($order->dishes->contains($dish))
                                <div class="order-btn row{{ $order->id }}" style="order: 1;"
                                    onclick="window.location='{{ route('admin.orders.show', $order->id) }}'">
                                    <div class="row order">

                                        <div class="col name">
                                            <span>{{ $order->client_name }}</span>
                                        </div>

                                        <div class="col status">
                                            <span
                                                class="badge {{ $order->status === 'pending' ? 'text-bg-warning' : ($order->status === 'accepted' ? 'text-bg-success' : 'text-bg-danger') }}">{{ $order->status }}</span>
                                        </div>

                                        <div class="col date">
                                            <span>{{ $order->created_at }}</span>
                                        </div>

                                        <div class="col total">
                                            <span id="{{ $order->id }}total">€
                                                {{ number_format($order->total, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
                <div class="d-flex justify-content-center align-items-center m-5">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary"><i
                            class="fa-solid fa-clipboard-list fs-5 me-1"></i> Visualizza
                        ordini</a>
                </div>
            </div>

            <div class="col glass p-4">
                <h3>Ordinato negli ultimi sei mesi</h3>
                <canvas id="line-chart"></canvas>

                <div class="d-flex justify-content-center align-items-center m-5">
                    <a href="" class="btn btn-primary"><i class="fa-solid fa-chart-line fs-5 me-1"></i> Visualizza
                        statistiche</a>

                </div>
            </div>

        </div>

    </div>

    <script>
        let orders = {!! json_encode($orders) !!};

        // line chart
        const line = document.getElementById('line-chart');
        let lastSixMonths = [];
        let dishOrdered = [0, 0, 0, 0, 0, 0]
        for (let i = 0; i < 6; i++) {
            lastSixMonths.push(new Date(new Date().setMonth(new Date().getMonth() - i)).getMonth() + 1)
        }

        lastSixMonths = lastSixMonths.reverse();

        orders.forEach(order => {
            if (lastSixMonths.includes(new Date(order.created_at).getMonth() + 1)) {
                order.dishes.forEach(dish => {
                    if (dish.name === '{{ $dish->name }}') {

                        dishOrdered[lastSixMonths.indexOf(new Date(order.created_at).getMonth() + 1)] += 1 *
                            dish.pivot.quantity
                    }
                })
            }
        })

        lastSixMonths.forEach((month, i) => {
            switch (month) {
                case 1:
                    lastSixMonths[i] = 'Gennaio';
                    break;
                case 2:
                    lastSixMonths[i] = 'Febbraio';
                    break;
                case 3:
                    lastSixMonths[i] = 'Marzo';
                    break;
                case 4:
                    lastSixMonths[i] = 'Aprile';
                    break;
                case 5:
                    lastSixMonths[i] = 'Maggio';
                    break;
                case 6:
                    lastSixMonths[i] = 'Giugno';
                    break;
                case 7:
                    lastSixMonths[i] = 'Luglio';
                    break;
                case 8:
                    lastSixMonths[i] = 'Agosto';
                    break;
                case 9:
                    lastSixMonths[i] = 'Settembre';
                    break;
                case 10:
                    lastSixMonths[i] = 'Ottobre';
                    break;
                case 11:
                    lastSixMonths[i] = 'Novembre';
                    break;
                case 12:
                    lastSixMonths[i] = 'Dicembre';
                    break;
                default:
                    break;
            }
        })
        // lastSixMonths = lastSixMonths.reverse()
        new Chart(line, {
            type: 'line',
            data: {
                labels: lastSixMonths,
                datasets: [{
                    label: 'Quantità ordinata',
                    data: dishOrdered,
                    hoverBorderWidth: 5,
                    borderWidth: 1,
                    borderColor: 'rgba(142, 250, 246, 1)',
                    backgroundColor: 'rgba(142, 250, 246, 1)'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        function orderByClient() {
            tableIcons.forEach(tableIcon => {
                tableIcon.classList.add('d-none');
            })
            clientIcon.classList.remove('d-none');
            let names = [];
            orderRows.forEach(orderRow => {
                names.push(orderRow.children[0].children[1].children[0].innerHTML);
            })
            names.sort()
            if (orderClient) {
                clientIcon.classList.remove('fa-sort-up');
                clientIcon.classList.add('fa-sort-down');

            } else {
                clientIcon.classList.remove('fa-sort-down');
                clientIcon.classList.add('fa-sort-up');
                names.reverse()
            }
            orderRows.forEach(orderRow => {
                orderRow.style.order = names.indexOf(orderRow.children[0].children[1].children[0].innerHTML) +
                    1;
            })
            orderClient = !orderClient;
        }



        function orderByStatus() {
            tableIcons.forEach(tableIcon => {
                tableIcon.classList.add('d-none');
            })
            statusIcon.classList.remove('d-none');
            if (orderStatus) {
                statusIcon.classList.remove('fa-sort-up');
                statusIcon.classList.add('fa-sort-down');
                orderRows.forEach(orderRow => {
                    switch (orderRow.children[0].children[1].children[0].innerHTML) {
                        case "accepted":
                            orderRow.style.order = "1";
                            break;
                        case "pending":
                            orderRow.style.order = "2";
                            break;
                        case "rejected":
                            orderRow.style.order = "3";
                            break;
                        default:
                            break;
                    }
                })
            } else {
                statusIcon.classList.remove('fa-sort-down');
                statusIcon.classList.add('fa-sort-up');
                orderRows.forEach(orderRow => {
                    switch (orderRow.children[0].children[1].children[0].innerHTML) {
                        case "accepted":
                            orderRow.style.order = "3";
                            break;
                        case "pending":
                            orderRow.style.order = "2";
                            break;
                        case "rejected":
                            orderRow.style.order = "1";
                            break;
                        default:
                            break;
                    }
                })
            }
            orderStatus = !orderStatus
        }



        function orderByDate() {
            tableIcons.forEach(tableIcon => {
                tableIcon.classList.add('d-none');
            })
            dateIcon.classList.remove('d-none');
            let dates = [];
            orderRows.forEach(orderRow => {
                dates.push(new Date(orderRow.children[0].children[2].children[0].innerHTML));
            })
            dates.sort((a, b) => a - b)
            let datesISO = [];
            dates.forEach(date => {
                datesISO.push(date.toISOString())
            })
            if (orderDate) {
                dateIcon.classList.remove('fa-sort-up');
                dateIcon.classList.add('fa-sort-down');
            } else {
                dateIcon.classList.remove('fa-sort-down');
                dateIcon.classList.add('fa-sort-up');
                datesISO.reverse();
            }
            orderRows.forEach(orderRow => {
                orderRow.style.order = datesISO.indexOf(new Date(orderRow.children[0].children[2].children[0]
                        .innerHTML)
                    .toISOString()) + 1;
            })
            orderDate = !orderDate
        }



        const orderRows = document.querySelectorAll('.order-btn')
        const tableIcons = document.querySelectorAll('.table-btn .table-icon');
        const clientIcon = document.getElementById('client-icon');
        const statusIcon = document.getElementById('status-icon');
        const dateIcon = document.getElementById('date-icon');
        const totalIcon = document.getElementById('total-icon');
        let orderClient = true;
        let orderStatus = true;
        let orderDate = true;
        let orderTotal = true;



        function orderByTotal() {
            tableIcons.forEach(tableIcon => {
                tableIcon.classList.add('d-none');
            })
            totalIcon.classList.remove('d-none');
            let totals = [];
            orderRows.forEach(orderRow => {
                totals.push(orderRow.children[0].children[3].children[0].innerHTML.substring(2));
            })
            totals.sort((a, b) => a - b)
            if (orderTotal) {
                totalIcon.classList.remove('fa-sort-up');
                totalIcon.classList.add('fa-sort-down');
            } else {
                totalIcon.classList.remove('fa-sort-down');
                totalIcon.classList.add('fa-sort-up');
                totals.reverse();
            }
            orderRows.forEach(orderRow => {
                orderRow.style.order = totals.indexOf(orderRow.children[0].children[3].children[0].innerHTML
                        .substring(2)) +
                    1;
            })
            orderTotal = !orderTotal
        }
    </script>

    {{-- delete form --}}
    <form action="{{ route('admin.dishes.destroy', $dish) }}" method="POST">
        @csrf
        @method('DELETE')


        <!-- Modal -->
        <div class="modal fade" id="{{ $dish->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content text-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="warningTitle">ATTENZIONE</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Sei sicuro di voler eliminare il piatto {{ $dish->name }}?</p>
                        <p>Questa azione è irreversibile.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">ANNULLA</button>
                        <input id="deleteBtn" class="btn btn-danger fw-bold" type="submit" value="ELIMINA">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <style scoped>
        .img-container {
            max-width: 600px;
            max-height: 400px;
            object-fit: cover;
            object-position: center;
        }

        .img-container img {
            object-position: center;
            object-fit: cover;
            max-width: 100%;
            max-height: 100%;
        }

        .section-title {
            border-bottom: 1px dotted grey;
        }

        .order-btn {
            border-radius: 16px;
        }

        .order-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
            cursor: pointer;
        }

        .order-btn .row {
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
            height: 240px;
            overflow-y: auto;
            overflow-x: hidden;
        }
    </style>
@endsection
