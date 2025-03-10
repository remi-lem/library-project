<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Editeur;
use Illuminate\Http\Request;

class EditeurController extends Controller {

    public function create()
    {
        return view('editeur.create');
    }

    public function store(Request $request)
    {
        $editeur = Editeur::create([
            'nom' => $request->get('nom'),
        ]);

        return redirect()->route('tome.create')->with(['success' => 'Editeur enregistré', 'idEditeur' => $editeur->id]);
    }
}
