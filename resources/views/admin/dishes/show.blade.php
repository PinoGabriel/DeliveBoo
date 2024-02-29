@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        @if ($dish->user_id === auth()->user()->id)
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ substr($dish->img, 0, 6) == 'upload' ? asset('/storage' . '/' . $dish->img) : $dish->img }}"
                            class="card-img-top" alt="{{ $dish->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $dish->name }}</h5>
                            <p class="card-text">{{ $dish->description }}</p>
                            <p class="card-text">Price: ${{ $dish->price }}</p>
                            <p class="card-text">{{ $dish->visibility ? 'Visible' : 'Not Visible' }}</p>
                            <form action="{{ route('admin.dishes.destroy', $dish->id) }}" method="POST"
                                class="d-inline-block mb-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    </div>
@endsection
