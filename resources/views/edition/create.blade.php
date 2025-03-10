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

                    <div class="mb-3 col-md-6 col-12">
                        <label for="idSerie" class="form-label">Série</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <select class="form-select" id="idSerie" name="idSerie">
                                <option value="">Sélectionner une série</option>
                                @foreach($series as $serie)
                                    <option value="{{ $serie->id }}" {{ session('idSerie') == $serie->id || old('idSerie') == $serie->id ? 'selected' : '' }}>{{ $serie->nom }}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('serie.create') }}" type="button" class="btn btn-icon btn-secondary ms-2">
                                <span class="tf-icons bx bx-list-plus bx-22px"></span>
                            </a>
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="nom" class="form-label">Nom de l'édition</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
