@extends('layouts/contentNavbarLayoutLibrary')

@section('title', 'Ajouter à ma collection')

@section('content')
    @php
        use Filament\Forms;
        use App\Filament\Admin\Resources\TomeResource;
    @endphp
    <h1>Ajouter un tome à ma collection</h1>

    <form action="{{ route('tome.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="ISBN" class="form-label">ISBN</label>
            <input type="text" class="form-control" id="ISBN" name="ISBN" value="{{ old('ISBN') }}" maxlength="13" required>
        </div>

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre') }}" required>
        </div>

        <div class="mb-3">
            <label for="idEditeur" class="form-label">Éditeur</label>
            <select class="form-select" id="idEditeur" name="idEditeur" required>
                <option value="">Sélectionner un éditeur</option>
                @foreach($editeurs as $editeur)
                    <option value="{{ $editeur->id }}" {{ old('idEditeur') == $editeur->id ? 'selected' : '' }}>{{ $editeur->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="couverture" class="form-label">URL de la couverture</label>
            <input type="text" class="form-control" id="couverture" name="couverture" value="{{ old('couverture') }}">
        </div>

        <div class="mb-3">
            <label for="idAuteur" class="form-label">Auteur</label>
            <select class="form-select" id="idAuteur" name="idAuteur" required>
                <option value="">Sélectionner un auteur</option>
                @foreach($auteurs as $auteur)
                    <option value="{{ $auteur->id }}" {{ old('idAuteur') == $auteur->id ? 'selected' : '' }}>{{ $auteur->nomComplet }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="idGenreLivre" class="form-label">Genre</label>
            <select class="form-select" id="idGenreLivre" name="idGenreLivre" required>
                <option value="">Sélectionner un genre</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ old('idGenreLivre') == $genre->id ? 'selected' : '' }}>{{ $genre->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="dateParution" class="form-label">Date de parution</label>
            <input type="date" class="form-control" id="dateParution" name="dateParution" value="{{ old('dateParution') }}" required>
        </div>

        <div class="mb-3">
            <label for="numero" class="form-label">Numéro</label>
            <input type="number" class="form-control" id="numero" name="numero" value="{{ old('numero') }}" min="0" required>
        </div>

        <div class="mb-3">
            <label for="idEdition" class="form-label">Édition</label>
            <select class="form-select" id="idEdition" name="idEdition" required>
                <option value="">Sélectionner une édition</option>
                @foreach($editions as $edition)
                    <option value="{{ $edition->id }}" {{ old('idEdition') == $edition->id ? 'selected' : '' }}>{{ $edition->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="idTypeLivre" class="form-label">Type de livre</label>
            <select class="form-select" id="idTypeLivre" name="idTypeLivre" required>
                <option value="">Sélectionner un type de livre</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ old('idTypeLivre') == $type->id ? 'selected' : '' }}>{{ $type->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <select class="form-select" id="tags" name="tags[]" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>{{ $tag->nom }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>


@endsection
