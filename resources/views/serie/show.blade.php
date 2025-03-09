@extends('layouts.contentNavbarLayoutLibrary')

@section('title', $serie->nom)

@section('vendor-style')
@vite('resources/assets/vendor/libs/apex-charts/apex-charts.scss')
@endsection

@section('page-script')
    <script>
        function showPopup(ISBN, titre) {
            document.getElementById('ISBN').value = ISBN;
            document.getElementById('tomeTitle').innerText = titre;
            var myModal = new bootstrap.Modal(document.getElementById('popupAddCollection'), {
                keyboard: false
            });
            myModal.show();
        }
    </script>
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
            <h4>Tags :</h4>
            <ul>
                @foreach ($tags as $tag)
                    <li>{{ $tag }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    @foreach ($tomesCollectionUser as $tt)
        <p>{{ $tt }}</p>
        
    @endforeach

    <h2>Les éditions</h2>
    @foreach ($editions as $e)
        <div class="edition">
            <h3>{{ $e->nom }}</h3>
            <div class="row">
            @foreach ($tomeEditions[$e->id]->chunk(10) as $chunk)
                <div class="row mb-3">
                @foreach ($chunk as $tome)
                    <div class="col-md-1">
                        <div class="tome-container" >
                            <img src="{{ $tome->couverture }}" alt="couverture" class="img-fluid tome-image" style="{{ in_array($tome->ISBN, $tomesCollectionUser) ? '' : 'opacity: 0.5;' }}" onmouseover="this.style.opacity=1;" onmouseout="this.style.opacity='{{ in_array($tome->ISBN, $tomesCollectionUser) ? '1' : '0.5' }}';" @if(!in_array($tome->ISBN, $tomesCollectionUser)) onclick="showPopup('{{ $tome->ISBN }}', '{{ $tome->titre }}')" @endif>
                            <div class="tome-title">{{ $tome->titre }}</div>
                        </div>
                    </div>
                @endforeach
                </div>
            @endforeach
            </div>
        </div>
        
    @endforeach

    <!-- PopUp ajout collection -->
    <div class="modal fade" id="popupAddCollection" tabindex="-1" aria-labelledby="popupAddCollectionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupAddCollectionLabel">Ajouter à ma collection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir ajouter ce tome à votre collection ?</p>
                    <p id="tomeTitle"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form action="{{ route('collection.addTome') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ISBN" id="ISBN">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>

        document.getElementById('addToCollectionButton').addEventListener('click', function() {
            var ISBN = this.getAttribute('ISBN');
            // Envoyer une requête AJAX pour ajouter le tome à la collection de l'utilisateur
            fetch('/add-to-collection', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ tomeId: tomeId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Tome ajouté à votre collection');
                    location.reload();
                } else {
                    alert('Erreur lors de l\'ajout du tome à votre collection');
                }
            });
        });
    </script>
@endsection
