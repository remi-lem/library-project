<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\Edition;
use App\Models\Tome;
use \App\Models\TagTome;
use App\Models\Collection;

class SerieController extends Controller {

    //Actions générales

    //Donne la couverture d'une série (celle du 1er Tome)
    private function cover(int $idSerie){
        $edition = Edition::where('idSerie', $idSerie)->first();
        if($edition){
            $tome = Tome::where('idEdition', $edition->id)->first();
            if($tome){
                return $tome->couverture;
            }
        }
        //Si la couverture n'existe pas ou pas trouvable, on renvoie une image par défaut
        return asset('images/noCover.png');
    }

    //Donne les tags d'une série
    private function tags(int $idSerie){
        //collections pour les tags
        $tags = collect();
        //récupère chaque éditions et chaque tomes pour chaque éditions
        $editions = Edition::where('idSerie', $idSerie)->get();
        foreach($editions as $edition){
            $tomes = Tome::where('idEdition', $edition->id)->get();

            foreach($tomes as $tome){
                $tagTomes = TagTome::where('ISBN', $tome->ISBN)->get();
                foreach($tagTomes as $tagTome){
                    $tag = \App\Models\Tag::find($tagTome->idTag);
                    if ($tag) {
                        $tags->push($tag->nom);
                    }
                }
            }
        }
        return $tags->unique();
    }

    //Donne les tomes d'une collection d'un utilisateur selon une série
    private function tomesCollectionUser(int $idSerie, int $idUser){
        $tomes = [];
        //collection de l'utilisateur
        $tomescollection = Collection::where('id', $idUser)->get();
        foreach($tomescollection as $collection){
            //Pour chaque Tome
            $tome = Tome::where('ISBN', $collection->ISBN)->first();
            if($tome){
            //On récupère l'édition et vérifie si elle appartient à la série
            $edition = Edition::where('id', $tome->idEdition)->first();
            if($edition && $edition->idSerie == $idSerie){
                $tomes[] = $tome->ISBN;
            }
            }
        }
        return $tomes;
    }
    


    //Pages

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
                'cover' => $this->cover($serie->id)
            ]);
        }
        return view('serie.index', compact('seriesWithCover','series'));
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

    //affiche une série
    public function show(int $id){
        //Chercher la série
        $serie = Serie::findOrFail($id);

        //la couverture 
        $cover = $this->cover($serie->id);

        //les tags de la série
        $tags = $this->tags($serie->id);

        //les tomes de la collection de l'utilisateur
        $tomesCollectionUser = $this->tomesCollectionUser($serie->id, auth()->id());

        //Chercher les éditions et les tomes    
        $editions = Edition::where('idSerie', $serie->id)->get();
        $tomeEditions = [];
        foreach($editions as $edition){
            $tomeEditions[$edition->id] = Tome::where('idEdition', $edition->id)->get();
        }
        return view('serie.show', compact('serie', 'editions', 'tomeEditions','cover','tags','tomesCollectionUser'));
    }

    


}
?>
