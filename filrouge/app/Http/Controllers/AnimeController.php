<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Anime;



class AnimeController extends Controller
{

    public function create($content_id)
    {
        $content = Content::findOrFail($content_id);
        return view('anime.form', compact('content_id'));
     }
   public function store(Request $request)
    {
        $validated = $request->validate([
            'content_id' => 'required|exists:contents,id',
            'nbr_episodes' => 'required|integer|min:1',
            'nbr_saisons' => 'required|integer|min:1',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'producteur' => 'required|string',
        ]);

        Anime::create($validated);
        return redirect()->route('content.index')->with('success', 'Anime bien ajoute.');
    }
    public function show($id)
    {
        $anime = Anime::with('content')->findOrFail($id);
        return view('anime.details', compact('anime'));
    } 
}
