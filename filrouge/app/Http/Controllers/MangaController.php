<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\Content;
use App\Models\Notation;
use App\Models\Commentaire;

class MangaController extends Controller
{
    public function create($content_id)
    {
        $content = Content::findOrFail($content_id);
        return view('manga.form', compact('content_id'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content_id' => 'required|exists:contents,id',
            'nbr_chapitres' => 'required|integer|min:1',
            'auteur' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        Manga::create($validated);
        return redirect()->route('content.index')->with('success', 'Manga ajouté avec succès.');
    }

    public function show($id)
    {
        $manga = Manga::with('content')->findOrFail($id);
        $averageRating = Notation::where('content_id', $manga->content->id)->avg('note');
        $comments = Commentaire::where('content_id', $manga->content->id)
                                           ->whereNull('episode_id')
                                           ->whereNull('chapitre_id')
                                           ->get();
    
        return view('manga.details', compact('manga', 'averageRating', 'comments'));
    }
}
