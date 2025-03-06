@php
    $isMenu = false;
    $navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayoutLibrary')

@section('title', 'Accueil')

@section('content')

    <h1>Bienvenue sur {{config('app.name')}}</h1>

    @guest
        <a class="btn btn-primary" href="{{route('register')}}">Créer un compte</a>
        <a class="btn btn-primary" href="{{route('dashboard-library')}}">Se connecter</a>
    @endguest

    @auth
        <a class="btn btn-primary" href="{{route('dashboard-library')}}">Accéder à ma bibliothèque</a>
    @endauth

    {{--//TODO presentation (image)--}}

@endsection
