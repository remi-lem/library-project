<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\GenreLivre;
use Illuminate\Http\Request;

class GenreLivreController extends Controller {

    public function create()
    {
        return view('genreLivre.create');
    }

    public function store(Request $request)
    {
        GenreLivre::create([
            'nom' => $request->get('nom'),
        ]);

        return redirect()->route('genreLivre.create')->with('success', 'Genre crée');
    }
}
