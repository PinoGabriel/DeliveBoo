@extends('layouts.admin')

@section('content')
    <div class="container-fluid my-4">
        <div class="row justify-content-center gap-4">
            @foreach ($user->restaurant->dishes as $dish)
                <div class="col-auto">

                    <div class="card">
                        <div class="card-img-top overflow-hidden">
                            <img src="{{ substr($dish->img, 0, 6) == 'upload' ? asset('/storage' . '/' . $dish->img) : $dish->img }}"
                                class="w-100" alt="{{ $dish->name }}">
                        </div>
                        <div class="card-body">
                            <div class="card-header mb-3 d-flex justify-content-between">
                                <h5 class="card-title">{{ mb_strimwidth($dish->name, 0, 33, '...') }}</h5>
                                @if ($dish->visibility)
                                    <i class="fa-solid fa-eye"></i>
                                @else
                                    <i class="fa-solid fa-eye-slash"></i>
                                @endif

                            </div>
                            <ul class="fa-ul">
                                <li><span class="fa-li"><i class="fa-solid fa-coins"></i></span>€{{ $dish->price }}
                                </li>
                            </ul>

                            <div class="buttons">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.dishes.show', $dish) }}"
                                        class="btn btn-primary d-flex justify-content-center align-items-center"><i
                                            class="fa-solid fa-circle-info me-2 fs-5"></i><span> Più informazioni</span></a>
                                    <a href="{{ route('admin.dishes.edit', $dish) }}"
                                        class="btn btn-warning d-flex justify-content-center align-items-center"><i
                                            class="fa-solid fa-pencil fs-5"></i></a>
                                    <!-- Button trigger modal -->
                                    <button type="button"
                                        class="btn btn-danger d-flex justify-content-center align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#{{ $dish->id }}">
                                        <i class="fa-solid fa-trash-can fs-5"></i>
                                    </button>


                                </div>
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
                                        <button type="button" class="btn btn-secondary fw-bold"
                                            data-bs-dismiss="modal">ANNULLA</button>
                                        <input id="deleteBtn" class="btn btn-danger fw-bold" type="submit" value="ELIMINA">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <style scoped>
        .card {
            width: 400px;
            padding: 0;
        }

    <style>@endsection
