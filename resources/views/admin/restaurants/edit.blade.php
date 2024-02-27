@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Modifica ristorante:</h2>
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
            <form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $restaurant->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>

                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" value="{{ old('description', $restaurant->description) }}">
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="p_iva" class="form-label">Partita Iva:</label>
                    <input type="text" class="form-control @error('p_iva') is-invalid @enderror" id="p_iva"
                        name="p_iva" value="{{ old('p_iva', $restaurant->p_iva) }}">
                    @error('p_iva')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label @error('address') is-invalid @enderror">Indirizzo</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ old('address', $restaurant->address) }}">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Immagine:</label>
            <input type="text" class="form-control @error('img') is-invalid @enderror" id="img" name="img"
                value="{{ old('img', $restaurant->img) }}">
            @error('img')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipi:</label>
            <select multiple name="types[]" id="type" class="form-select">
                @foreach ($types as $type)
                    <option
                        {{ in_array($type->id, old('types', $restaurant->types->pluck('id')->toArray())) ? 'selected' : '' }}
                        value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            @error('types')
                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
        <a href="{{ route('admin.restaurants.index') }}" class="btn btn-warning">Torna alla lista dei ristoranti</a>
    </div>
    </div>
@endsection
