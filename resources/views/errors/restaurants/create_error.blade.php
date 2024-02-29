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
            <h1 class="text-center">Oh no! Non puoi creare un ristorante poichè ne hai già uno</h1>
            <a href="{{ route('admin.restaurants.index') }}" class="btn btn-primary mt-3 d-flex align-items-center"><i
                    class="fa-solid fa-circle-left me-3 fs-5"></i><span>Torna al mio ristorante</span></a>
        </div>
    </div>
@endsection
