<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurController extends Controller {

    public function create()
    {
        return view('auteur.create');
    }

    public function store(Request $request)
    {
        $auteur = Auteur::create([
            'nom' => $request->get('nom'),
            'prenom' => $request->get('prenom'),
        ]);

        return redirect()->route('tome.create', ['idAuteur' => $auteur->id])->with('success', 'Auteur enregistré');
    }
}
