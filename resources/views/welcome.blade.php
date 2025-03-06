@php
    $isMenu = false;
    $navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayoutLibrary')

@section('title', 'Without menu - Layouts')

@section('content')

    <h1>Bienvenue sur {{config('app.name')}}</h1>

    @auth
        <a href="{{route('dashboard-library')}}">Accéder à {{config('app.name')}}</a>
    @endauth

@endsection
