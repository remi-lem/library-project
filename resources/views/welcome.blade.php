@php
    $isMenu = false;
    $navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayoutLibrary')

@section('title', 'Accueil')

@section('content')

    <div class="jumbotron text-center bg-light py-5 shadow-sm rounded">
        <div class="container">
            <h1 class="display-3">Bienvenue sur {{ config('app.name') }}</h1>
            <p class="lead">Ne perdez jamais le fil de vos lectures. Avec {{ config('app.name') }}, votre bibliothèque vous suit partout !</p>

            <div class="d-flex justify-content-center">
                @guest
                    <a class="btn btn-primary mx-2" href="{{ route('register') }}">Créer un compte</a>
                    <a class="btn btn-secondary mx-2" href="{{ route('collection') }}">Se connecter</a>
                @endguest

                @auth
                    <a class="btn btn-primary" href="{{ route('collection') }}">Accéder à ma bibliothèque</a>
                @endauth
            </div>
        </div>
    </div>

    <div class="container text-center py-5">
        <div class="row">
            <div class="col-md-4">
                <div class="icon">
                    <i class="bx bx-book-heart text-brown" style="font-size: 80px;"></i>
                </div>
                <h3 class="mt-3 text-uppercase fw-bold text-brown">📚 Votre collection</h3>
                <p>Gardez précieusement vos livres et suivez vos lectures comme un véritable bibliothécaire en herbe !</p>
            </div>
            <div class="col-md-4">
                <div class="icon">
                    <i class="bx bx-globe text-brown" style="font-size: 80px;"></i>
                </div>
                <h3 class="mt-3 text-uppercase fw-bold text-brown">🌍 N'importe où</h3>
                <p>Votre bibliothèque vous suit partout ! Accédez à vos trésors littéraires en un clic, où que vous soyez.</p>
            </div>
            <div class="col-md-4">
                <div class="icon">
                    <i class="bx bx-search-alt-2 text-brown" style="font-size: 80px;"></i>
                </div>
                <h3 class="mt-3 text-uppercase fw-bold text-brown">🔍 Quoi lire ?</h3>
                <p>En panne d'inspiration ? Trouvez votre prochaine pépite parmi des milliers d’histoires captivantes !</p>
            </div>
        </div>
    </div>

    <div class="container text-center py-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('images/Bibliotheque-remplie.webp') }}" alt="Bibliothèque remplie" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <h3 class="text-uppercase fw-bold text-brown">Votre bibliothèque déborde ?</h3>
                <p>Pas de panique ! {{ config('app.name') }} est la solution pour gérer vos livres numériques et garder votre collection bien organisée, même en déplacement.</p>
            </div>
        </div>
    </div>


@endsection
