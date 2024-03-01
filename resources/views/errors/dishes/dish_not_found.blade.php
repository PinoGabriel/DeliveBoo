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
            <h1 class="text-center">Oh no! Non puoi editare un piatto non esistente</h1>
            <button onclick="history.back()" class="btn btn-primary mt-3 d-flex align-items-center"><i
                    class="fa-solid fa-circle-left me-3 fs-5"></i><span>
                    Torna alla modifica del mio piatto</span></button>
        </div>
    </div>
@endsection

<script></script>
