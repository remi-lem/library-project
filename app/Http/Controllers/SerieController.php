<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Serie as Serie; //def du modèle en le renommant
use app\Models\Edition as Edition;
use app\Models\Tome as Tome;

class SerieController extends Controller{

    //affiche All
    public function index(){
        $series = Serie::all();
        return view('serie.index', compact('series'));
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


    //Création/suppression/modification
    //Page
    public function create(){
        return view('serie.create');
    }

    //Action
    public function store(Request $request){
        $serie = new Serie();
        $serie->title = $request->title;
        $serie->publication_year = $request->publication_year;
        $serie->save();
        return redirect()->route('serie.index');
    }

    public function destroy(Serie $serie){
        $serie->delete();
        return redirect()->route('serie.index');
    }

    //Page
    public function edit(Serie $serie){
        return view('serie.edit', compact('serie'));
    }
    //Action
    public function update(Request $request, Serie $serie){
        $serie->title = $request->title;
        $serie->publication_year = $request->publication_year;
        $serie->save();
        return redirect()->route('serie.index');
    }

    //Recherche par titre
    public function search(Request $request){
        $search = $request->search;
        $series = Serie::where('title', 'like', "%$search%")->get();
        return view('serie.index', compact('series'));
    }

    //Recherche filtrée
    public function filter(Request $request){
        $query = Serie::query();

        foreach ($request->all() as $key => $value) {
            if (!empty($value)) {
                $query->where($key, '=', $value);
            }
        }

        $series = $query->get();
        return view('serie.index', compact('series'));
    }

    //Recherche triée
    public function sort(Request $request){
        $series = Serie::orderBy($request->sort)->get();
        return view('serie.index', compact('series'));
    }

    //Recherche triée et filtrée
    public function sortFilter(Request $request){
        $query = Serie::query();

        foreach ($request->all() as $key => $value) {
            if (!empty($value)) {
                $query->where($key, '=', $value);
            }
        }

        $series = $query->orderBy($request->sort)->get();
        return view('serie.index', compact('series'));
    }


}
?>
