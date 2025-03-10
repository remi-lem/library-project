@extends('layouts/contentNavbarLayoutLibrary')

@section('title', 'Ajouter à ma collection')

@section('content')
    <h1>Ajouter un tome à ma collection</h1>
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
            <form action="{{ route('tome.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6 col-12">
                        <label for="ISBN" class="form-label">ISBN</label>
                        <input type="number" class="form-control" id="ISBN" name="ISBN" value="{{ old('ISBN') }}" min="0" maxlength="13" required>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre') }}" required>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="idEditeur" class="form-label">Éditeur</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <select class="form-select" id="idEditeur" name="idEditeur" required>
                                <option value="">Sélectionner un éditeur</option>
                                @foreach($editeurs as $editeur)
                                    <option value="{{ $editeur->id }}" {{ session('idEditeur') == $editeur->id || old('idEditeur') == $editeur->id ? 'selected' : '' }}>{{ $editeur->nom }}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('editeur.create') }}" type="button" class="btn btn-icon btn-secondary ms-2">
                                <span class="tf-icons bx bx-book-add bx-22px"></span>
                            </a>
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="couverture" class="form-label">URL de la couverture</label>
                        <input type="text" class="form-control" id="couverture" name="couverture" value="{{ old('couverture') }}">
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="idAuteur" class="form-label">Auteur</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <select class="form-select" id="idAuteur" name="idAuteur" required>
                                <option value="">Sélectionner un auteur</option>
                                @foreach($auteurs as $auteur)
                                    <option value="{{ $auteur->id }}" {{ session('idAuteur') == $auteur->id || old('idAuteur') == $auteur->id ? 'selected' : '' }}>{{ $auteur->nomComplet }}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('auteur.create') }}" type="button" class="btn btn-icon btn-secondary ms-2">
                                <span class="tf-icons bx bx-user-plus bx-22px"></span>
                            </a>
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="idGenreLivre" class="form-label">Genre</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <select class="form-select" id="idGenreLivre" name="idGenreLivre" required>
                                <option value="">Sélectionner un genre</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ session('idGenreLivre') == $genre->id || old('idGenreLivre') == $genre->id ? 'selected' : '' }}>{{ $genre->nom }}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('genreLivre.create') }}" type="button" class="btn btn-icon btn-secondary ms-2">
                                <span class="tf-icons bx bx-book-add bx-22px"></span>
                            </a>
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="dateParution" class="form-label">Date de parution</label>
                        <input type="date" class="form-control" id="dateParution" name="dateParution" value="{{ old('dateParution') }}" required>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="numero" class="form-label">Numéro</label>
                        <input type="number" class="form-control" id="numero" name="numero" value="{{ old('numero') }}" min="0" required>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="idEdition" class="form-label">Édition</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <select class="form-select" id="idEdition" name="idEdition">
                                <option value="">Sélectionner une édition</option>
                                @foreach($editions as $key => $value)
                                    <option value="{{ $key }}" {{ session('idEdition') == $key || old('idEdition') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('edition.create') }}" type="button" class="btn btn-icon btn-secondary ms-2">
                                <span class="tf-icons bx bx-book-add bx-22px"></span>
                            </a>
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="idTypeLivre" class="form-label">Type de livre</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <select class="form-select" id="idTypeLivre" name="idTypeLivre" required>
                                <option value="">Sélectionner un type de livre</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ session('idTypeLivre') == $type->id || old('idTypeLivre') == $type->id ? 'selected' : '' }}>{{ $type->nom }}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('typeLivre.create') }}" type="button" class="btn btn-icon btn-secondary ms-2">
                                <span class="tf-icons bx bx-book-add bx-22px"></span>
                            </a>
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="tags" class="form-label">Tags</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <select class="form-select" id="tags" name="tags[]" multiple>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ session('idTag') == $tag->id || in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>{{ $tag->nom }}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('tag.create') }}" type="button" class="btn btn-icon btn-secondary ms-2">
                                <span class="tf-icons bx bx-folder-plus bx-22px"></span>
                            </a>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
