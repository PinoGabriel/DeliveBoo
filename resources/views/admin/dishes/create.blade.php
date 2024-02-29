@extends('layouts.admin')

@section('content')
    <div class="container card my-4 py-2">
        <div class="row">
            <h2>Nuovo Piatto:</h2>

            {{-- errors container --}}
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

            {{-- form --}}
            <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- name input --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nome*</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') ?? '' }}" placeholder="Inserisci il nome" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- description input --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea rows="6" type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" value="{{ old('description') ?? '' }}" placeholder="Inserisci una descrizione"></textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- price/image input --}}
                <div class="mb-3 d-flex gap-3">
                    {{-- price input --}}
                    <div class="w-50">
                        <label for="price" class="form-label">Price*</label>
                        <input type="number" step=".01" class="form-control @error('price') is-invalid @enderror"
                            id="price" name="price" value = "{{ old('price') ?? '' }}" placeholder="00.00" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- image input --}}
                    <div class="w-50">
                        <label for="img" class="form-label">Immagine*</label>
                        <input type="file" class="form-control @error('img') is-invalid @enderror" id="img"
                            name="img" required>
                        @error('img')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                {{-- visibility checkbox --}}
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="visibility" id="visibility" value="1"
                        {{ old('visibility') ? 'checked' : '' }}>
                    <label class="form-check-label @error('visibility') is-invalid @enderror"
                        for="visibility">Visibile</label>
                    @error('visibility')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="my-3">* campi obbligatori</div>
                <div class="d-flex gap-3 mb-1">
                    {{-- submit button --}}
                    <button type="submit" class="btn btn-primary">Aggiungi</button>
                    <a href="{{ route('admin.restaurants.show', $user->restaurant->id) }}"
                        class="btn btn-secondary">Annulla</a>
                </div>
            </form>
        </div>
    </div>
@endsection
