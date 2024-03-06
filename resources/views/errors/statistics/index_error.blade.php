@extends('layouts.admin')

@section('content')
    <div class="my-errors">
        <spaguetti>
            <fork></fork>
            <meat></meat>
            <pasta></pasta>
            <plate></plate>
        </spaguetti>
        <div class="pt-5 d-flex flex-column align-items-center justify-content-center">
            <h1 class="text-center">Mi spiace! La pagina delle statistiche la vedrai dopo il primo ordine</h1>
            <a href="{{ route('admin.restaurants.show', $user->restaurant->id) }}"
                class="btn btn-primary mt-3 d-flex align-items-center"><i class="fa-solid fa-circle-left me-3 fs-5"></i><span>
                    Torna al tuo ristorante</span></a>
        </div>
    </div>
@endsection

<style>
    plate:before {
        content: 'OPS' !important;
        position: absolute;
        top: 50 %;
        left: 50 %;
        transform: translate(-50 %, -50 %);
        text - transform: uppercase;
        font - weight: bold;
        color: rgba(0, 0, 0, .2);
        text - align: center;
    }
</style>
