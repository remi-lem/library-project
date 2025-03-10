<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\TypeLivre;
use Illuminate\Http\Request;

class TypeLivreController extends Controller {

    public function create()
    {
        return view('typeLivre.create');
    }

    public function store(Request $request)
    {
        TypeLivre::create([
            'nom' => $request->get('nom'),
        ]);

        return redirect()->route('typeLivre.create')->with('success', 'Type crée');
    }
}
