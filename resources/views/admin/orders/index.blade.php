@extends('layouts.admin')

@section('content')
    <div class="container glass my-4">
        <div class="row p-3">
            <div class="col">
                <span class="table-btn p-2" onclick="orderByID()">
                    ID
                    <i id="id-icon" class="fas fa-sort-down ms-1 d-none table-icon"></i>
                </span>
            </div>
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
                <div class="order-btn row{{ $order->id }}" style="order: 1;"
                    onclick="window.location='{{ route('admin.orders.show', $order->id) }}'">
                    <div class="row order">
                        <div class="col id">
                            <span>{{ $order->id }}</span>
                        </div>

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
                            <span id="{{ $order->id }}total"></span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>




    <script>
        let orders = {!! json_encode($orders) !!};
        orders.forEach(order => {
            let total = 0;
            order.dishes.forEach(dish => {
                total += dish.price * dish.pivot.quantity;
            });

            document.getElementById(order.id + 'total').innerHTML = "€ " + total.toFixed(2);
        });

        const orderRows = document.querySelectorAll('.order-btn')
        const tableIcons = document.querySelectorAll('.table-btn .table-icon');
        const idIcon = document.getElementById('id-icon');
        const clientIcon = document.getElementById('client-icon');
        const statusIcon = document.getElementById('status-icon');
        const dateIcon = document.getElementById('date-icon');
        const totalIcon = document.getElementById('total-icon');
        let orderId = true;
        let orderClient = true;
        let orderStatus = true;
        let orderDate = true;
        let orderTotal = true;



        function orderByID() {
            tableIcons.forEach(tableIcon => {
                tableIcon.classList.add('d-none');
            })
            idIcon.classList.remove('d-none');
            if (orderId) {
                let count = 1;
                idIcon.classList.remove('fa-sort-up');
                idIcon.classList.add('fa-sort-down');
                orderRows.forEach(orderRow => {
                    orderRow.style.order = count++;
                })
            } else {
                let count = orderRows.length;
                idIcon.classList.remove('fa-sort-down');
                idIcon.classList.add('fa-sort-up');
                orderRows.forEach(orderRow => {
                    orderRow.style.order = count--;
                })
            }
            orderId = !orderId;
        }



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
                    switch (orderRow.children[0].children[2].children[0].innerHTML) {
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
                    switch (orderRow.children[0].children[2].children[0].innerHTML) {
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
                dates.push(new Date(orderRow.children[0].children[3].children[0].innerHTML));
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
                orderRow.style.order = datesISO.indexOf(new Date(orderRow.children[0].children[3].children[0]
                        .innerHTML)
                    .toISOString()) + 1;
            })
            orderDate = !orderDate
        }



        function orderByTotal() {
            tableIcons.forEach(tableIcon => {
                tableIcon.classList.add('d-none');
            })
            totalIcon.classList.remove('d-none');
            let totals = [];
            orderRows.forEach(orderRow => {
                totals.push(orderRow.children[0].children[4].children[0].innerHTML.substring(2));
            })
            totals.sort()
            if (orderTotal) {
                totalIcon.classList.remove('fa-sort-up');
                totalIcon.classList.add('fa-sort-down');
            } else {
                totalIcon.classList.remove('fa-sort-down');
                totalIcon.classList.add('fa-sort-up');
                totals.reverse();
            }
            orderRows.forEach(orderRow => {
                orderRow.style.order = totals.indexOf(orderRow.children[0].children[4].children[0].innerHTML
                        .substring(2)) +
                    1;
            })
            orderTotal = !orderTotal
        }
    </script>




    <style scoped>
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
            max-height: 50vh;
            overflow-y: auto;
            overflow-x: hidden;
        }
    </style>
@endsection
