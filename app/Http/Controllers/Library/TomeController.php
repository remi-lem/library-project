<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Auteur;
use App\Models\Editeur;
use App\Models\Edition;
use App\Models\GenreLivre;
use App\Models\Tag;
use App\Models\TypeLivre;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TomeController extends Controller {

    public function create()
    {
        $editeurs = Editeur::all();
        $auteurs = Auteur::all();
        $genres = GenreLivre::all();
        $editions = Edition::all();
        $types = TypeLivre::all();
        $tags = Tag::all();

        return view('tome.create', compact('editeurs', 'auteurs', 'genres', 'editions', 'types', 'tags'));
    }

    public function scan(){
        return view('tome.scan');
    }
}
