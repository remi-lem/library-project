<?php

namespace App\Http\Controllers\Library;

use Illuminate\Http\Request;
use App\Models\Tome;
use App\Models\Edition;
use App\Models\Serie;
use App\Http\Controllers\Controller;
use App\Models\Collection;


class CollectionController extends Controller {

    // Ajouter un tome à la collection
    public function addTome(Request $request){
        $tomeId = $request->input('ISBN');
        $userId = auth()->id();

        // Ajoutez le tome à la collection de l'utilisateur
        $collection = new Collection();
        $collection->id = $userId;
        $collection->ISBN = $tomeId;
        $collection->save();

        return redirect()->back()->with('success', 'Le tome a été ajouté à la collection.');
    }

    // Retirer un tome de la collection
    public function removeTome(Request $request){
        $tomeId = $request->input('ISBN');
        $userId = auth()->id();
<<<<<<< HEAD:app/Http/Controllers/CollectionController.php
        
        // Vérifie si le tome est dans la collection de l'utilisateur
=======

        //vérifie si le tome est dans la collection de l'utilisateur
>>>>>>> f866350a271d777b6dc312077e7952f07ca99281:app/Http/Controllers/Library/CollectionController.php
        $collection = Collection::where('id', $userId)->where('ISBN', $tomeId)->first();
        if($collection){
            // Supprimer la ligne dans la collection où id = $userId et ISBN = $tomeId
            Collection::where('id', $userId)->where('ISBN', $tomeId)->delete();
            return redirect()->back()->with('success', 'Le tome a été retiré de la collection.');
        }
        return redirect()->back()->with('error', 'Le tome n\'a pas pu être retiré de la collection.');
    }
<<<<<<< HEAD:app/Http/Controllers/CollectionController.php

    // Pages

    // Afficher les séries dont l'utilisateur a des tomes dans sa collection
    public function index(){
        //requête pour récupérer les séries dont l'utilisateur a des tomes dans sa collection
        $series = Serie::whereIn('id', function($query) {
            $query->select('Edition.idSerie')
            ->from('Collection')
            ->join('Tome', 'Collection.ISBN', '=', 'Tome.ISBN')
            ->join('Edition', 'Tome.idEdition', '=', 'Edition.id')
            ->where('Collection.id', auth()->id());
        })->orderBy('nom')->paginate(20);

        // Nouvelle collection pour ajouter les couvertures
        $seriesWithCover = collect();
        foreach($series as $serie){
            $seriesWithCover->push([
            'id' => $serie->id,
            'nom' => $serie->nom,
            'synopsis' => $serie->synopsis,
            'cover' => SerieController::cover($serie->id)
            ]);
        }

        return view('serie.index', compact('seriesWithCover', 'series'));
    }

    // Recherche triée et filtrée
    public function recherche(Request $request){
        $query = Serie::query();

        // Filtrage
        if ($request->has('nom') && !empty($request->input('nom'))) {
            $query->where('nom', 'LIKE', '%' . $request->input('nom') . '%');
        }

        // Tri
        $sortField = $request->input('sort', 'nom'); // Par défaut, trier par nom
        $series = $query->whereIn('id', function($query) {
            $query->select('Edition.idSerie')
            ->from('Collection')
            ->join('Tome', 'Collection.ISBN', '=', 'Tome.ISBN')
            ->join('Edition', 'Tome.idEdition', '=', 'Edition.id')
            ->where('Collection.id', auth()->id());
        })->orderBy($sortField)->paginate(20); // On pagine à 20 séries par page. 5 séries par ligne

        // Nouvelle collection pour ajouter les couvertures
        $seriesWithCover = collect();
        foreach($series as $serie){
            $seriesWithCover->push([
                'id' => $serie->id,
                'nom' => $serie->nom,
                'synopsis' => $serie->synopsis,
                'cover' => SerieController::cover($serie->id)
            ]);
        }

        return view('serie.index', compact('seriesWithCover', 'series'));
    }

    
}
=======
}
>>>>>>> f866350a271d777b6dc312077e7952f07ca99281:app/Http/Controllers/Library/CollectionController.php
