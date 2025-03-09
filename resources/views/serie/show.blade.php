@extends('layouts/contentNavbarLayoutLibrary')

@section('title', $serie->nom)

@section('vendor-style')
@vite('resources/assets/vendor/libs/apex-charts/apex-charts.scss')

@endsection

@section('vendor-script')
@vite('resources/assets/vendor/libs/apex-charts/apexcharts.js')
@endsection

@section('page-script')
@vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')
    <h1>{{ $serie->nom }}</h1>
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $cover }}" alt="couverture" class="card-img mb-3" style="object-fit: contain; height: 400px;">
        </div>
        <div class="col-md-8">
            <h4> Synopsis :</h4>
            <p> {{ $serie->synopsis }}</p>
        </div>
    </div>

    <h2>Les éditions</h2>
    @foreach ($editions as $e)
        <div class="edition">
            <h3>{{ $e->nom }}</h3>
            <div class="row">
            @foreach ($tomeEditions[$e->id]->chunk(10) as $chunk)
                <div class="row mb-3">
                @foreach ($chunk as $tome)
                    <div class="col-md-1">
                    <img src="{{ $tome->couverture }}" alt="couverture" class="img-fluid">
                    <p>{{ $tome->nom }}</p>
                    </div>
                @endforeach
                </div>
            @endforeach
            </div>
        </div>
        
    @endforeach
@endsection
