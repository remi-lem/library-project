<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\Edition;
use App\Models\Tome;

class SerieController extends Controller {

    //Donne la couverture d'une série (celle du 1er Tome)
    private function cover(Serie $serie){
        $edition = Edition::where('idSerie', $serie->id)->first();
        if($edition){
            $tome = Tome::where('idEdition', $edition->id)->first();
            if($tome){
                return $tome->couverture;
            }
        }
        //Si la 
        return asset('images/noCover.png');
    }

    //affiche All
    public function index(){
        $series = Serie::orderBy('nom')->paginate(20); // On trie par nom par défaut et on pagine à 20 séries par page. 5 séries par ligne

        //Nouvelle collection pour ajouter les couvertures
        $seriesWithCover = collect();
        foreach($series as $serie){
            $seriesWithCover->push([
                'id' => $serie->id,
                'nom' => $serie->nom,
                'synopsis' => $serie->synopsis,
                'cover' => $this->cover($serie)
            ]);
        }
        return view('serie.index', compact('seriesWithCover','series'));
    }

    //affiche un élément
    public function show(Serie $serie){
        $editions = Edition::where('serie_id', $serie->id)->get();
        $tomeEditions = [];
        foreach($editions as $edition){
            $tomeEditions[$edition->id] = Tome::where('edition_id', $edition->id)->get();
        }
        return view('serie.show', compact('serie'));
    }

    //Recherche triée et filtrée
    public function recherche(Request $request){
        $query = Serie::query();

        //Filtrage
        if ($request->has('nom') && !empty($request->input('nom'))) {
            $query->where('nom', 'LIKE', '%' . $request->input('nom') . '%');
        }

        //Tri
        $sortField = $request->input('sort', 'nom'); // Par défaut, trier par nom
        $series = $query->orderBy($sortField)->paginate(20); //On pagine à 20 séries par page. 5 séries par ligne

        // Nouvelle collection pour ajouter les couvertures
        $seriesWithCover = collect();
        foreach($series as $serie){
            $seriesWithCover->push([
                'id' => $serie->id,
                'nom' => $serie->nom,
                'synopsis' => $serie->synopsis,
                'cover' => $this->cover($serie)
            ]);
        }

        return view('serie.index', compact('seriesWithCover', 'series'));
    }


}
?>
