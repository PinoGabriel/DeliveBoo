@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            @if ($user->restaurant)
                <div class="col-md-4">
                    <div class="card">
                        <div><img
                                src="{{ substr($restaurant->img, 0, 6) == 'upload' ? asset('/storage' . $restaurant->img) : $restaurant->img }}"
                                class="card-img-top">
                        </div>
                        <div class="card-header">{{ $user->restaurant->name }}</div>
                        <div class="card-body">{{ $user->restaurant->description }}</div>
                        <div class="card-body"><span class="fw-bold">Partita Iva:</span> {{ $user->restaurant->p_iva }}</div>
                        <div class="card-body"><span class="fw-bold">Indirizzo:</span> {{ $user->restaurant->address }}
                        </div>
                        <div class="card-subtitle mb-2 text-muted pt-2">
                            @if (count($user->restaurant->types) > 0)
                                <ul>
                                    @foreach ($user->restaurant->types as $type)
                                        <li>#{{ $type->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No Types</p>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('admin.dishes.index') }}"
                                class="btn btn-primary m-2 w-100 d-flex justify-content-center align-items-center"><i
                                    class="fa-solid fa-utensils me-3 fs-5"></i><span> Mostra menù</span></a>
                            <a href="{{ route('admin.restaurants.edit', $user->restaurant->id) }}"
                                class="btn btn-warning m-2 w-25 d-flex justify-content-center align-items-center"><i
                                    class="fa-solid fa-pencil fs-5"></i></a>
                            <!-- Button trigger modal -->
                            <button type="button"
                                class="btn btn-danger m-2 w-25 d-flex justify-content-center align-items-center"
                                data-bs-toggle="modal" data-bs-target="#{{ $restaurant->id }}">
                                <i class="fa-solid fa-trash-can fs-5"></i>
                            </button>

                        </div>

                    </div>
                    <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST">
                        @csrf
                        @method('DELETE')


                        <!-- Modal -->
                        <div class="modal fade" id="{{ $restaurant->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <button type="button" class="btn btn-secondary fw-bold"
                                            data-bs-dismiss="modal">ANNULLA</button>
                                        <input id="deleteBtn" class="btn btn-danger fw-bold" type="submit" value="ELIMINA">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
@else
    <p>Nessun ristorante associato a questo utente.</p>
    @endif
    </div>
    </div>
@endsection
