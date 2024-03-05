@extends('layouts.admin')

@section('content')
    {{-- charts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="container my-4">

        <div class="row gap-4">

            <div class="col-12 col-md-6 glass p-4">
                <h3>Incassi degli ultimi sei mesi</h3>
                <canvas id="line-chart"></canvas>


            </div>

            <div class="col glass p-4">
                <h3>Totale incassi</h3>
                <canvas id="bar-chart"></canvas>
            </div>

        </div>

        <div class="row mt-4">
            <div class="col-12 col-md-6 glass p-4">
                <h3>Rapporto ordini rifiutati/accettati</h3>
                <canvas id="orders-doughnut-chart"></canvas>
            </div>


            <div class="col-12 ps-md-4 ps-0 pe-0 mt-4 mt-md-0 col-md-6 d-flex flex-wrap justify-content-between">

                <div id="service-buttons"
                    class="glass p-4 d-flex justify-content-center align-items-center gap-3 flex-wrap mb-4 w-100">
                    <a href="{{ route('admin.restaurants.show', $restaurant->id) }}" class="btn btn-primary"><i
                            class="fa-solid fa-utensils fs-5 me-1"></i><span class="d-inline d-md-none d-lg-inline">
                            Visualizza
                            ristorante</span></a>
                    <a href="{{ route('admin.dishes.index') }}" class="btn btn-primary"><i
                            class="fa-solid fa-bars fs-5 me-1"></i><span class="d-inline d-md-none d-lg-inline"> Visualizza
                            menù</span></a>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary"><i
                            class="fa-solid fa-clipboard-list fs-5 me-1"></i><span class="d-inline d-md-none d-lg-inline">
                            Visualizza
                            ordini</span></a>
                </div>

                <div class="glass p-4 w-100">
                    <h3>Andamento degli ordini negli ultimi 6 mesi</h3>
                    <canvas id="orders-line-chart"></canvas>

                </div>
            </div>
        </div>

        <div class="row gap-4 mt-4">

            <div class="col-12 glass p-4">
                <h3>Rapporto prezzo/quantità ordinata piatti</h3>
                <canvas id="dishes-mixed-chart"></canvas>
            </div>



        </div>





    </div>

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



        // doughnut chart
        const ordersDoughnut = document.getElementById('orders-doughnut-chart');
        let orderStatuses = [0, 0, 0];

        for (let order of orders) {
            if (order.status === 'rejected') {
                orderStatuses[0]++;
            } else if (order.status === 'accepted') {
                orderStatuses[1]++;
            } else if (order.status === 'pending') {
                orderStatuses[2]++;
            }
        }
        let doughnutData = {
            labels: ['Rejected', 'Accepted', 'Pending'],
            datasets: [{
                label: 'Ordini',
                data: orderStatuses,
                backgroundColor: [
                    'rgba(255, 61, 61, 0.6)',
                    'rgba(39, 211, 131, 0.6)',
                    'rgba(255, 226, 7, 0.6)',
                ],
                borderColor: [
                    'rgb(255, 61, 61)',
                    'rgb(39, 211, 131)',
                    'rgb(255, 226, 7)',
                ],
                borderWidth: 1
            }]
        }

        new Chart(ordersDoughnut, {
            type: 'doughnut',
            data: {
                labels: doughnutData.labels,
                datasets: [{
                    label: 'Ordini',
                    data: doughnutData.datasets[0].data,
                    backgroundColor: doughnutData.datasets[0].backgroundColor,
                    borderColor: doughnutData.datasets[0].borderColor,
                    hoverBorderWidth: 5,
                    borderWidth: 1
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


        //line chart
        const ordersLine = document.getElementById('orders-line-chart');
        lastSixMonths = [];
        for (let i = 0; i < 6; i++) {
            lastSixMonths.push(new Date(new Date().setMonth(new Date().getMonth() - i)).getMonth() + 1)
        }

        let ordersInLastSixMonth = [0, 0, 0, 0, 0, 0]

        orders.forEach(order => {
            let month = new Date(order.created_at).getMonth() + 1
            lastSixMonths.indexOf(month) !== -1 ? ordersInLastSixMonth[lastSixMonths.indexOf(month)] += 1 : null
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
        lastSixMonths = lastSixMonths.reverse()
        ordersInLastSixMonth = ordersInLastSixMonth.reverse()

        new Chart(ordersLine, {
            type: 'line',
            data: {
                labels: lastSixMonths,
                datasets: [{
                    label: 'Ordini',
                    data: ordersInLastSixMonth,
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



        // dishes mixed chart
        const dishes = {!! json_encode($restaurant->dishes) !!};
        let dishesQuanity = [];
        let totalQuantity = 0;
        dishes.forEach(dish => {
            dishesQuanity.push(0)
        })
        orders.forEach(order => {
            order.dishes.forEach(dish => {
                totalQuantity += dish.pivot.quantity
                dishes.forEach((d, i) => {
                    if (d.name === dish.name) {
                        dishesQuanity[i] += dish.pivot.quantity
                    }
                })
            })
        })
        let dishesQuantityPercentage = dishesQuanity.map(dish => {
            return (dish / totalQuantity) * 100
        })
        const dishesMixed = document.getElementById('dishes-mixed-chart');

        const dishesMixedChart = new Chart(dishesMixed, {
            data: {
                datasets: [{
                    type: 'bar',
                    label: 'Prezzo',
                    data: dishes.map(dish => dish.price),
                    borderWidth: 2,
                    borderColor: 'rgba(142, 250, 246, 1)',
                    backgroundColor: 'rgba(142, 250, 246, 0.2)'
                }, {
                    type: 'line',
                    label: 'Percentuale piatto ordinato',
                    data: dishesQuantityPercentage,
                    borderColor: 'rgb(255, 33, 33)',
                    backgroundColor: 'rgb(255, 33, 33)'
                }],
                labels: dishes.map(dish => dish.name)
            },
            options: {
                onHover: (e) => {
                    const canvasPosition = Chart.helpers.getRelativePosition(e, dishesMixedChart);
                    const dataX = dishesMixedChart.scales.x.getValueForPixel(canvasPosition.x);
                    const dataY = dishesMixedChart.scales.y.getValueForPixel(canvasPosition.y);
                    if (dishes.map(dish => dish.price)[dataX] >= dataY && dataY >= 0) {
                        dishesMixed.style.cursor = 'pointer';
                    } else {
                        dishesMixed.style.cursor = 'default';
                    }
                },
                onClick: (e) => {
                    const canvasPosition = Chart.helpers.getRelativePosition(e, dishesMixedChart);
                    const dataX = dishesMixedChart.scales.x.getValueForPixel(canvasPosition.x);
                    const dataY = dishesMixedChart.scales.y.getValueForPixel(canvasPosition.y);
                    if (dishes.map(dish => dish.price)[dataX] >= dataY) location.href =
                        `/admin/dishes/${dishes[dataX].id}`
                },
            }
        });
    </script>

    <style scoped>
        #service-buttons {
            height: auto;
            max-height: 45%;
        }
    </style>
@endsection
