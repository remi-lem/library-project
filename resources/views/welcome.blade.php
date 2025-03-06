@php
    $isMenu = false;
    $navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayoutLibrary')

@section('title', 'Accueil')

@section('content')

    <h1>Bienvenue sur {{config('app.name')}}</h1>

    @guest
        <a href="{{route('register')}}">Créer un compte</a>
    @endguest

    @auth
        <a href="{{route('dashboard-library')}}">Accéder à ma bibliothèque</a>
    @endauth

@endsection
