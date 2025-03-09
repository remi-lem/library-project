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
    <form action="{{ route('serie.recherche') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="nom" class="form-control" placeholder="Nom de la série">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </div>
    </form>
        @foreach ($seriesWithCover->chunk(5) as $chunk)
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-4 justify-content-center">
            @foreach ($chunk as $s)
                <div class="col-md-2 d-flex justify-content-center" style="transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    <div class="card h-100" style="width: 100%;">
                        <a href="{{ route('serie.show', $s["id"]) }}" class="stretched-link"></a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-center">{{ Str::limit($s["nom"], 15, '...') }}</h5>
                            <img src="{{ $s["cover"] }}" alt="couverture" class="card-img mb-3" style="object-fit: contain; height: 200px;">
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        @endforeach
    

    <div class="d-flex justify-content-center">
        {{ $series->appends(request()->input())->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
    <div class="d-flex justify-content-center">
        @php
            $displayedSeries = $series->perPage() * $series->currentPage();
            if ($displayedSeries > $series->total()) {
            $displayedSeries = $series->total();
            }
        @endphp
        <p>{{ $displayedSeries }} séries affichées sur {{ $series->total() }}</p>
    </div>
@endsection
