@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Modifica Piatto:</h2>
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
            <form action="{{ route('admin.dishes.update', $dish) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nome*</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $dish->name) }}" placeholder="Inserisci il nome" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>

                    <textarea rows="6" type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" value="{{ old('description', $dish->description) }}" placeholder="Inserisci una descrizione"></textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 d-flex gap-3">
                    <div class="w-50">
                        <label for="price" class="form-label">Price*</label>
                        <input type="number" step=".01" class="form-control @error('price') is-invalid @enderror"
                            id="price" name="price" value = "{{ old('price', $dish->price) }}" placeholder="00.00"
                            required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-50">
                        <label for="img" class="form-label">Immagine*</label>
                        <input type="file" class="form-control @error('img') is-invalid @enderror" id="img"
                            name="img">
                        @error('img')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        </div>
        <div class="mb-3">

        </div>
        <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" name="visibility" id="visibility" value="1"
                @if ($dish->visibility) checked @endif>
            <label class="form-check-label @error('visibility') is-invalid @enderror" for="visibility">Visibile</label>
            @error('visibility')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="my-3">* campi obbligatori</div>

        <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
        <a href="{{ route('admin.dishes.index') }}" class="btn btn-warning">Torna alla lista dei ristoranti</a>
    </div>
    </div>
@endsection
