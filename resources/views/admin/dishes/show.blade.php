@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4 card">
        <div class="row">
            <div class="img-container col-6">
                <img src="{{ substr($dish->img, 0, 6) == 'upload' ? asset('/storage' . '/' . $dish->img) : $dish->img }}"
                    alt="">
            </div>
            <div class="col-6 d-flex flex-column justify-content-between">
                <div class="mt-2">
                    <h1>{{ $dish->name }}</h1>
                    <ul class="fa-ul">
                        <li class="my-3"><span class="fa-li"><i
                                    class="fa-solid fa-location-dot"></i></span>{{ $dish->address }}
                        </li>
                        <li class="my-3"><span class="fa-li"><i
                                    class="fa-regular fa-eye"></i></span>{{ $dish->visibility ? 'Visible' : 'Not Visible' }}
                        </li>
                        <li class="my-3"><span class="fa-li"><i class="fa-solid fa-user"></i></span>{{ $user->name }}
                        </li>

                    </ul>
                </div>

                <div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.dishes.index') }}"
                            class="btn btn-primary d-flex justify-content-center align-items-center"><i
                                class="fa-solid fa-utensils me-3 fs-5"></i><span> Mostra tutti i piatti</span></a>
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
            padding: 0 !important;
            max-width: 600px;
            max-height: 400px;
            object-fit: cover;
            object-position: center;
            border-radius: 16px;
            overflow: hidden;
        }

        .img-container img {
            object-position: center;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .section-title {
            border-bottom: 1px dotted grey;
        }
    </style>
@endsection
