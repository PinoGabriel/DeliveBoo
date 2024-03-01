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
            <h1 class="text-center">Mi spiace! Non ci sono ordini per il tuo ristorante!</h1>
            <a href="{{ route('admin.restaurants.show', $user->restaurant->id) }}"
                class="btn btn-primary mt-3 d-flex align-items-center"><i class="fa-solid fa-circle-left me-3 fs-5"></i><span>
                    Torna al tuo ristorante</span></a>
        </div>
    </div>
@endsection
