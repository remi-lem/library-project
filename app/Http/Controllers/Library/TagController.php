<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller {

    public function create()
    {
        return view('tag.create');
    }

    public function store(Request $request)
    {
        $tag = Tag::create([
            'nom' => $request->get('nom'),
        ]);

        return redirect()->route('tome.create')->with(['success' => 'Tag enregistré', 'idTag' => $tag->id]);

    }
}
