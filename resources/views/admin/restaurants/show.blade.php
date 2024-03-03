@extends('layouts.admin')

@section('content')
    <div class="container my-4 glass p-3">
        <div class="row">
            <div class="img-container col-auto">
                <img class="img-fluid rounded-4 w-100"
                    src="{{ substr($restaurant->img, 0, 6) == 'upload' ? asset('/storage' . '/' . $restaurant->img) : $restaurant->img }}"
                    alt="">
            </div>
            <div class="col-auto d-flex flex-column justify-content-between">
                <div class="mt-2">
                    <h1>{{ $restaurant->name }}</h1>
                    <ul class="fa-ul">
                        <li class="my-3"><span class="fa-li"><i
                                    class="fa-solid fa-location-dot"></i></span>{{ $restaurant->address }}
                        </li>
                        <li class="my-3"><span class="fa-li"><i
                                    class="fa-solid fa-user"></i></span>{{ $restaurant->user->name }}</li>
                        <li class="my-3"><span class="fa-li"><i class="fa-solid fa-utensils"></i></span>
                            @if (count($restaurant->types) > 0)
                                @foreach ($restaurant->types as $type)
                                    <span class="badge rounded-pill bg-secondary">{{ $type->name }}</span>
                                @endforeach
                            @else
                                No Types
                            @endif
                        </li>
                    </ul>
                </div>

                <div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.dishes.index') }}"
                            class="btn btn-primary d-flex justify-content-center align-items-center"><i
                                class="fa-solid fa-utensils me-2 fs-5"></i><span> Mostra menù</span></a>
                        <a href="{{ route('admin.restaurants.edit', $user->restaurant->id) }}"
                            class="btn btn-warning d-flex justify-content-center align-items-center"><i
                                class="fa-solid fa-pencil fs-5"></i></a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger d-flex justify-content-center align-items-center"
                            data-bs-toggle="modal" data-bs-target="#{{ $restaurant->id }}">
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
                <p>{{ $restaurant->description }}</p>
            </div>

        </div>
    </div>

    {{-- charts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="container mb-4">

        <div class="row gap-4">

            <div class="col-12 col-md-6 glass p-4">
                <h3>Incassi degli ultimi sei mesi</h3>
                <canvas id="line-chart"></canvas>

                <div class="d-flex justify-content-center align-items-center m-5">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary"><i
                            class="fa-solid fa-clipboard-list fs-5 me-1"></i> Visualizza
                        ordini</a>

                </div>
            </div>

            <div class="col glass p-4">
                <h3>Totale incassi</h3>
                <canvas id="bar-chart"></canvas>

                <div class="d-flex justify-content-center align-items-center m-5">
                    <a href="" class="btn btn-primary"><i class="fa-solid fa-chart-line fs-5 me-1"></i> Visualizza
                        statistiche</a>

                </div>
            </div>

        </div>

    </div>


    {{-- delete form --}}
    <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST">
        @csrf
        @method('DELETE')


        <!-- Modal -->
        <div class="modal fade" id="{{ $restaurant->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content text-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="warningTitle">ATTENZIONE</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Sei sicuro di voler eliminare il ristorante {{ $restaurant->name }}?</p>
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

    <script>
        let orders = {!! json_encode($orders) !!};

        // line chart
        const line = document.getElementById('line-chart');
        let lastSixMonths = [];
        let lastSixMonthsIncoming = [0.00, 0.00, 0.00, 0.00, 0.00, 0.00];
        let lastSixMonthsPending = [0.00, 0.00, 0.00, 0.00, 0.00, 0.00];
        let lastSixMonthsTotal = [0.00, 0.00, 0.00, 0.00, 0.00, 0.00];
        let incomingTotal = [0.00, 0.00]
        for (let i = 0; i < 6; i++) {
            lastSixMonths.push(new Date(new Date().setMonth(new Date().getMonth() - i)).getMonth() + 1)
        }

        lastSixMonths = lastSixMonths.reverse();

        orders.forEach(order => {
            if (order.status !== 'rejected') {
                incomingTotal[1] += order.total;
            }
            if (order.status !== 'rejected' && order.status !== 'pending') {
                incomingTotal[0] += order.total
            }
            if (lastSixMonths.includes(new Date(order.created_at).getMonth() + 1)) {
                lastSixMonthsTotal[lastSixMonths.indexOf(new Date(order.created_at)
                    .getMonth() + 1)] += order.total;

                if (order.status !== 'rejected') {
                    lastSixMonthsPending[lastSixMonths.indexOf(new Date(order.created_at).getMonth() +
                        1)] += order.total
                }

                if (order.status !== 'rejected' && order.status !== 'pending') {
                    lastSixMonthsIncoming[lastSixMonths.indexOf(new Date(order.created_at).getMonth() +
                        1)] += order.total
                }

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
                    label: 'Totale netto',
                    data: lastSixMonthsIncoming,
                    hoverBorderWidth: 5,
                    borderWidth: 1,
                    borderColor: 'rgb(31, 135, 88)',
                    backgroundColor: 'rgb(31, 135, 88)'
                }, {
                    label: 'Totale contabile',
                    data: lastSixMonthsPending,
                    hoverBorderWidth: 5,
                    borderWidth: 1,
                    borderColor: 'rgb(254, 193, 58)',
                    backgroundColor: 'rgb(254, 193, 58)'

                }, {
                    label: 'Totale con ordini rifiutati',
                    data: lastSixMonthsTotal,
                    hoverBorderWidth: 5,
                    borderWidth: 1,
                    borderColor: 'rgb(218, 55, 72)',
                    backgroundColor: 'rgb(218, 55, 72)'

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

        // bar chart
        const bar = document.getElementById('bar-chart');

        new Chart(bar, {
            type: 'bar',
            data: {
                labels: ['Totale netto', 'Totale contabile'],
                datasets: [{
                    label: 'Incassi',
                    data: incomingTotal,
                    hoverBorderWidth: 5,
                    borderWidth: 1,
                    borderColor: 'rgb(98, 173, 170)',
                    backgroundColor: 'rgba(142, 250, 246, 0.8)'
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
    </script>

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
    </style>
@endsection
