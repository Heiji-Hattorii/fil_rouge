<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Anime;
use App\Models\Commentaire;

class EpisodeController extends Controller
{
    public function index($anime_id)
    {
        $anime = Anime::with('content')->findOrFail($anime_id);
        $episodes = Episode::where('anime_id', $anime_id)->get();
        return view('anime.episodes.index', compact('anime', 'episodes'));
    }

    public function store(Request $request, $anime_id)
{
    $request->validate([
        'numero_episode' => 'required|integer',
        'contenu' => 'required|file|mimes:mp4,avi,mov,wmv',
        'date_ajout' => 'required|date',
    ]);

    if ($request->hasFile('contenu')) {
        $video = $request->file('contenu');
        $filename = time() . '_' . $video->getClientOriginalName();
        $video->move(public_path('episodes'), $filename);
        $contenu = 'episodes/' . $filename;
    } else {
        $contenu = null;
    }

    Episode::create([
        'anime_id' => $anime_id,
        'numero_episode' => $request->numero_episode,
        'contenu' => $contenu,
        'date_ajout' => $request->date_ajout,
    ]);

    return redirect()->route('anime.episodes.index', $anime_id)
                     ->with('success', 'Épisode ajouté avec succès.');
}


public function show($anime_id, $id)
{
    $episode = Episode::findOrFail($id);
    
    $comments = Commentaire::where('episode_id', $id)->orderBy('created_at', 'desc')->get();

    return view('anime.episodes.show', compact('episode', 'comments'));
}


    public function update(Request $request, $anime_id, $id)
    {
        $request->validate([
            'numero_episode' => 'required|integer',
            'contenu' => 'nullable|file|mimes:mp4,avi,mov,wmv',
            'date_ajout' => 'required|date',
        ]);
    
        $episode = Episode::findOrFail($id);
    
        if ($request->hasFile('contenu')) {
            $video = $request->file('contenu');
            $filename = time() . '_' . $video->getClientOriginalName();
            $video->move(public_path('episodes'), $filename);
            $contenu = 'episodes/' . $filename;
    
            if ($episode->contenu && file_exists(public_path($episode->contenu))) {
                unlink(public_path($episode->contenu));
            }
    
            $episode->contenu = $contenu;
        }
    
        $episode->numero_episode = $request->numero_episode;
        $episode->date_ajout = $request->date_ajout;
        $episode->save();
    
        return redirect()->route('anime.episodes.index', $anime_id)
                         ->with('success', 'Épisode mis à jour avec succès.');
    }
    

    public function destroy($anime_id, $id)
    {
        $episode = Episode::findOrFail($id);
        $episode->delete();

        return redirect()->route('anime.episodes.index', $anime_id)
                         ->with('success', 'Épisode supprimé avec succès.');
    }
}
