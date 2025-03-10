<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Edition;
use App\Models\Serie;
use Illuminate\Http\Request;

class EditionController extends Controller {

    public function create()
    {
        $series = Serie::all();

        return view('edition.create', compact('series'));
    }

    public function store(Request $request)
    {
        Edition::create([
            'nom' => $request->get('nom'),
            'idSerie' => $request->get('idSerie'),
        ]);

        return redirect()->route('edition.create')->with('success', 'Éditeur crée');
    }
}
