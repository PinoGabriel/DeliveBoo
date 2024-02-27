@extends('layouts.admin')

@section('content')
    <div class="container">
        @auth
            @if (Auth::user()->restaurant)
                <p>Non hai accesso a questa pagina perché hai già un ristorante associato.</p>
            @else
                <div class="row">
                    <h2>Nuovo Ristorante:</h2>
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
                                name="name" value="{{ old('name') ?? '' }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione</label>

                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" value="{{ old('description') ?? '' }}">
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="p_iva" class="form-label">Partita Iva:</label>
                            <input type="text" class="form-control @error('p_iva') is-invalid @enderror" id="p_iva"
                                name="p_iva" value = "{{ old('p_iva') ?? '' }}">
                            @error('p_iva')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Indirizzo</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                name="address" value="{{ old('address') ?? '' }}">
                        </div>
                </div>
                <div class="mb-3">
                    <label for="img" class="form-label">Immagine:</label>
                    <input type="text" class="form-control @error('img') is-invalid @enderror" id="img" name="img"
                        value="{{ old('img') ?? '' }}">
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
            @endif
        @else
            <p>Questa pagina è disponibile solo per utenti autenticati. Effettua il login per accedere.</p>
        @endauth
    </div>
    </div>
@endsection


{{-- <!DOCTYPE html>
<html>
<head>
    <title>La Tua Pagina</title>
</head>
<body>

    <header>
        <h1>La Tua Pagina</h1>
    </header>

    <div>
        @auth
            @if (Auth::user()->ristorante)
                <!-- Contenuti visibili solo agli utenti autenticati con un ristorante -->
                <p>Non hai accesso a questa pagina perché hai già un ristorante associato.</p>
            @else
                <!-- Contenuti visibili solo agli utenti autenticati senza un ristorante -->
                <p>Benvenuto! Puoi accedere a questa pagina perché non hai ancora un ristorante associato.</p>
                <!-- Altri contenuti per utenti autenticati senza un ristorante -->
            @endif
        @else
            <!-- Contenuti visibili solo agli utenti non autenticati -->
            <p>Questa pagina è disponibile solo per utenti autenticati. Effettua il login per accedere.</p>
            <!-- Altri contenuti per utenti non autenticati -->
        @endauth
    </div>

    <footer>
        <p>Il tuo piè di pagina</p>
    </footer>

</body>
</html> --}}
