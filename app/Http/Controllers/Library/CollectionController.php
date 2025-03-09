<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller {


    //ajouter un tome à la collection
    public function addTome(Request $request){
        //id Tome et user
        $tomeId = $request->input('ISBN');
        $userId = auth()->id();

        // Ajoutez le tome à la collection de l'utilisateur
        $collection = new Collection();
        $collection->id = $userId;
        $collection->ISBN = $tomeId;
        $collection->save();

        return redirect()->back()->with('success', 'Le tome a été ajouté à la collection.');
    }

    //retirer un tome de la collection
    public function removeTome(Request $request){
        //id Tome et user
        $tomeId = $request->input('ISBN');
        $userId = auth()->id();

        //vérifie si le tome est dans la collection de l'utilisateur
        $collection = Collection::where('id', $userId)->where('ISBN', $tomeId)->first();
        if($collection){
            // Supprimer la ligne dans la collection où id = $userId et ISBN = $tomeId
            Collection::where('id', $userId)->where('ISBN', $tomeId)->delete();
            return redirect()->back()->with('success', 'Le tome a été retiré de la collection.');
        }
        return redirect()->back()->with('error', 'Le tome n\'a pas pu être retiré de la collection.');
    }
}
