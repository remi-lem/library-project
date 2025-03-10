@extends('layouts/contentNavbarLayoutLibrary')

@section('title', 'Ajouter une édition')

@section('content')
    <h1>Ajouter une édition</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('edition.store') }}" method="POST">
                @csrf
                <div class="row">

                    <a href="{{ route('serie.create') }}" class="btn btn-secondary">Ajouter une série</a>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="idSerie" class="form-label">Série</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <select class="form-select" id="idSerie" name="idSerie">
                                <option value="">Sélectionner une série</option>
                                @foreach($series as $serie)
                                    <option value="{{ $serie->id }}" {{ old('idSerie') == $serie->id ? 'selected' : '' }}>{{ $serie->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

@endsection
