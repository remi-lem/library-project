@extends('layouts/contentNavbarLayoutLibrary')

@section('title', 'Les séries')

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
    <h1>Les séries</h1>
    <p> {{ $series->total() }} séries dans la base </p>
    
    <div class="row">
        @foreach ($seriesWithCover->chunk(5) as $chunk)
            @foreach ($chunk as $s)
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-nom">{{ $s["nom"] }}</h5>
                            <img src="{{ $s["cover"] }}" alt="couverture" class="card-cover">
                            {{-- <a href="{{ route('serie.show', $s["id"]) }}" class="btn btn-primary">Voir la série</a> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $series->links() }}
    </div>
@endsection
