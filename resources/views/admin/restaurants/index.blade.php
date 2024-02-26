@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            @if ($user->restaurant)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{ $user->restaurant->name }}</div>
                        <div class="card-body">{{ $user->restaurant->description }}</div>
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
                            <a href="{{ route('admin.restaurants.show', $user->restaurant->id) }}"
                                class="btn btn-primary mx-2 mb-2">Show
                                details</a>
                            <a href="{{ route('admin.restaurants.edit', $user->restaurant->id) }}"
                                class="btn btn-info mx-2 mb-2">Edit</a>
                            <form action="{{ route('admin.restaurants.destroy', $user->restaurant->id) }}" method="POST"
                                class="d-inline-block mx-2 mb-2">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger">
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
