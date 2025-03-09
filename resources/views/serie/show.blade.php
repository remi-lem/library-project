@extends('layouts.contentNavbarLayoutLibrary')

@section('title', $serie->nom)

@section('vendor-style')
@vite('resources/assets/vendor/libs/apex-charts/apex-charts.scss')
@endsection

@section('page-script')
    <script>
        function showPopup(ISBN, titre, action) {
            document.getElementById('ISBN').value = ISBN;
            document.getElementById('tomeTitle').innerText = titre;
            document.getElementById('action').value = action;
            if (action === 'add') {
                document.getElementById('popupAddCollectionLabel').innerText = 'Ajouter à ma collection';
                document.getElementById('popupMessage').innerText = 'Êtes-vous sûr de vouloir ajouter ce tome à votre collection ?';
                document.getElementById('popupForm').action = '{{ route('collection.addTome') }}';

                //bouton sendAction
                document.getElementById('popupSubmitButton').innerText = 'Ajouter';
                document.getElementById('popupSubmitButton').style.backgroundColor = 'purple';
                document.getElementById('popupSubmitButton').classList.add('btn-primary');
                document.getElementById('popupSubmitButton').classList.remove('btn-danger');
            } else {
                document.getElementById('popupAddCollectionLabel').innerText = 'Retirer de ma collection';
                document.getElementById('popupMessage').innerText = 'Êtes-vous sûr de vouloir retirer ce tome de votre collection ?';
                document.getElementById('popupForm').action = '{{ route('collection.removeTome') }}';

                //bouton sendAction
                document.getElementById('popupSubmitButton').innerText = 'Retirer';
                document.getElementById('popupSubmitButton').style.backgroundColor = 'red';
                document.getElementById('popupSubmitButton').classList.add('btn-danger');
                document.getElementById('popupSubmitButton').classList.remove('btn-primary');
            }
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
                        <div class="tome-container">
                            <img src="{{ $tome->couverture }}" alt="couverture" class="img-fluid tome-image" style="{{ in_array($tome->ISBN, $tomesCollectionUser) ? '' : 'opacity: 0.5;' }}; cursor: pointer;" onmouseover="this.style.opacity=1;" onmouseout="this.style.opacity='{{ in_array($tome->ISBN, $tomesCollectionUser) ? '1' : '0.5' }}';" onclick="showPopup('{{ $tome->ISBN }}', '{{ $tome->titre }}', '{{ in_array($tome->ISBN, $tomesCollectionUser) ? 'remove' : 'add' }}')">
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
                    <p id="popupMessage">Êtes-vous sûr de vouloir ajouter ce tome à votre collection ?</p>
                    <p id="tomeTitle"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Annuler</button>
                    <form id="popupForm" action="{{ route('collection.addTome') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ISBN" id="ISBN">
                        <input type="hidden" name="action" id="action">
                        <button type="submit" class="btn btn-primary" id="popupSubmitButton">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
