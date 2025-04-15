<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Anime;

class CommentaireController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        Commentaire::create([
            'user_id' => Auth::id(),
            'content_id' => $request->content_id,
            'chapitre_id' => $request->chapitre_id,
            'episode_id' => $request->episode_id,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Commentaire ajouté avec succès.');
    }

}
