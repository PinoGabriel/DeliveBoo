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
            <form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 d-flex gap-3">
                    <div class="w-50">
                        <label for="name" class="form-label">Nome*</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $restaurant->name) }}" placeholder="Inserisci il nome"
                            required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="w-50">
                        <label for="p_iva" class="form-label">Partita Iva*</label>
                        <input type="text" class="form-control @error('p_iva') is-invalid @enderror" id="p_iva"
                            name="p_iva" value="{{ old('p_iva', $restaurant->p_iva) }}"
                            placeholder="Inserisci la partita iva" required>
                        @error('p_iva')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>

                    <textarea rows="6" type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" placeholder="Inserisci una descrizione">{{ old('description', $restaurant->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="address" class="form-label @error('address') is-invalid @enderror">Indirizzo*</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ old('address', $restaurant->address) }}"
                            placeholder="Via, civico, città, provincia, CAP" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="img" class="form-label">Immagine*</label>
                        <input type="file" class="form-control @error('img') is-invalid @enderror" id="img"
                            name="img" value="{{ old('img', $restaurant->img) }}" required>
                        @error('img')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        </div>
        <div class="mb-3">
            <label class="mb-2">types*</label>
            <div class="checkbox-groups">
                @foreach ($types as $type)
                    <div class="form-check form-check-inline w-25">
                        <input class="form-check-input @error('types') is-invalid @enderror" type="checkbox" name="types[]"
                            id="type{{ $type->id }}" value="{{ $type->id }}"
                            {{ in_array($type->id, old('types', $restaurant->types->pluck('id')->toArray())) ? 'checked' : '' }}>

                        <label class="form-check-label" for="type{{ $type->id }}">
                            {{ $type->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="my-3">* campi obbligatori</div>
        <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
        <a href="{{ route('admin.restaurants.index') }}" class="btn btn-warning">Torna alla lista dei ristoranti</a>
    </div>
    </div>

    <style scoped>
        .map {
            /* width: 500px; */
            height: 500px !important;
        }
    </style>

    <script>
        Geocoder::getCoordinatesForAddress('Samberstraat 69, Antwerpen, Belgium');
    </script>
@endsection
