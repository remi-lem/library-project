<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Auteur;
use App\Models\Collection;
use App\Models\Editeur;
use App\Models\Edition;
use App\Models\GenreLivre;
use App\Models\Serie;
use App\Models\Tag;
use App\Models\TagTome;
use App\Models\Tome;
use App\Models\TypeLivre;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TomeController extends Controller {

    public function create()
    {
        $editeurs = Editeur::all();
        $auteurs = Auteur::all();
        $genres = GenreLivre::all();

        $series = Serie::all();
        $editions = [];
        foreach ($series as $serie) {
            $editionsSerie = Edition::where('idSerie', $serie->id)->get();
            foreach ($editionsSerie as $editionSerie) {
                $editions[$editionSerie->id] = $serie->nom . ' - ' . $editionSerie->nom;
            }
        }

        asort($editions);

        $types = TypeLivre::all();
        $tags = Tag::all();

        return view('tome.create', compact('editeurs', 'auteurs', 'genres', 'editions', 'types', 'tags'));
    }

    public function scan(){
        return view('tome.scan');
    }

    public function store(Request $request)
    {

        $request->validate([
            'ISBN' => 'required|numeric|min:0|max:9999999999999',
            'titre' => 'required|string|max:255',
            'idEditeur' => 'required|exists:Editeur,id',
            'couverture' => 'nullable|url',
            'idAuteur' => 'required|exists:Auteur,id',
            'idGenreLivre' => 'required|exists:GenreLivre,id',
            'dateParution' => 'required|date',
            'numero' => 'required|numeric|min:1',
            'idEdition' => 'nullable|exists:Edition,id',
            'idTypeLivre' => 'required|exists:TypeLivre,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:TagTome,idTag'
        ]);

        try {

            DB::beginTransaction();

            if ($request->filled('couverture')) {
                $couverture = $request->couverture;
            } else {
                $edition = Edition::find($request->idEdition);

                if ($edition && $edition->serie) {
                    $pattern = config('library.urlPattern');
                    $couverture = str_replace('<IMG>', $request->ISBN, $pattern);
                } else {
                    $couverture = null;
                }
            }

            $tome = Tome::create([
                'ISBN' => $request->ISBN,
                'titre' => $request->titre,
                'couverture' => $couverture,
                'dateParution' => $request->dateParution,
                'numero' => $request->numero,
                'idEditeur' => $request->idEditeur,
                'idAuteur' => $request->idAuteur,
                'idGenreLivre' => $request->idGenreLivre,
                'idEdition' => $request->idEdition,
                'idTypeLivre' => $request->idTypeLivre
            ]);

            if ($request->has('tags')) {
                $tags = array_values($request->tags);
                foreach ($tags as $tagId) {
                    TagTome::create([
                        'ISBN' => $tome->ISBN,
                        'idTag' => $tagId,
                    ]);
                }
            }

            $userId = auth()->id();

            $collection = new Collection();
            $collection->id = $userId;
            $collection->ISBN = $request->ISBN;
            $collection->save();

            DB::commit();
            return redirect()->route('tome.create')->with('success', 'Tome ajouté à votre collection !');
        } catch (QueryException $e) {
            DB::rollBack();

            return back()->with('error', 'Une erreur est survenue lors de l\'ajout du tome: ' . $e->getMessage());
        }
    }
}
