<?php
namespace App\Http\Controllers;

use App\Models\Notation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotationController extends Controller
{
    public function store(Request $request, $contentId)
    {
        // Validation des entrées
        $request->validate([
            'note' => 'required|integer|between:1,5',
        ]);

        $userId = Auth::id();

        // Vérifier si l'utilisateur a déjà noté ce contenu
        $notation = Notation::where('content_id', $contentId)
                             ->where('user_id', $userId)
                             ->first();

        if ($notation) {
            $notation->update(['note' => $request->note]);
        } else {
            Notation::create([
                'content_id' => $contentId,
                'user_id' => $userId,
                'note' => $request->note,
            ]);
        }

        

        return back()->with('success', 'Votre note a été enregistrée avec succès!');
    }

    public function getAverageRating($contentId)
    {
        $averageRating = Notation::where('content_id', $contentId)
                                  ->avg('note');

        return round($averageRating, 1);
    }
}