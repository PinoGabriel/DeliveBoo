@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h2>New Restaurant</h2>
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
            <form action="{{ route('admin.restaurants.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>

                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description">
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="p_iva" class="form-label">Partita Iva:</label>
                    <input type="text" class="form-control @error('p_iva') is-invalid @enderror" id="p_iva"
                        name="p_iva">
                    @error('p_iva')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Indirizzo</label>
                    <input type="text" class="form-control" id="address" name="address">
                </div>
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Immagine:</label>
            <input type="text" class="form-control" id="img" name="img">
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipi:</label>
            <select multiple name="types[]" id="" class="form-select">
                <option value="">Non ci sono tipi</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>
        <a href="{{ route('admin.restaurants.index') }}" class="btn btn-warning">Torna alla lista dei ristoranti</a>
    </div>
    </div>
@endsection
