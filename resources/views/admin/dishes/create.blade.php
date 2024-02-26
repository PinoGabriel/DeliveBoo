@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Nuovo Piatto:</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="row">
            <form action="{{ route('admin.dishes.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') ?? '' }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>

                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" value="{{ old('description') ?? '' }}">
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" step=".01" class="form-control @error('price') is-invalid @enderror"
                        id="price" name="price" value = "{{ old('price') ?? '' }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Immagine:</label>
            <input type="text" class="form-control @error('img') is-invalid @enderror" id="img" name="img"
                value="{{ old('img') ?? '' }}">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="visibility" id="visibility" value="1"
                {{ old('visibility') ? 'checked' : '' }}>
            <label for="visibility">Visibile</label>
        </div>

        <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>
        <a href="{{ route('admin.dishes.index') }}" class="btn btn-warning">Torna alla lista dei ristoranti</a>
    </div>
    </div>
@endsection
