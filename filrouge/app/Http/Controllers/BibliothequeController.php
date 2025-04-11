<?php
namespace App\Http\Controllers;

use App\Models\Bibliotheque;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BibliothequeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bibliotheques = $user->bibliotheques()->with('content')->get();
        $contents = Content::all();  
    
        return view('bibliotheques.index', compact('bibliotheques', 'contents'));  // Passer à la vue
    }
    public function myindex()
    {
        $contents = Content::all();
        $bibliothequeIds = Bibliotheque::where('user_id', auth()->id())->pluck('content_id')->toArray();
        return view('content.index', compact('contents', 'bibliothequeIds'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'content_id' => 'required|exists:contents,id',
            'statut' => 'required|in:en cours,a voir,termine',
        ]);

        $user = Auth::user();

        Bibliotheque::create([
            'user_id' => $user->id,
            'content_id' => $request->content_id,
            'statut' => $request->statut,
        ]);

        return redirect()->route('bibliotheques.index')->with('success', 'Contenu ajouté à votre bibliothèque.');
    }

    public function ajouter(Request $request, $content_id)
    {
        $user = auth()->user();

        $dejaAjoute = Bibliotheque::where('user_id', $user->id)
            ->where('content_id', $content_id)
            ->exists();

        if ($dejaAjoute) {
            return redirect()->back()->with('message', 'Ce contenu est déjà dans votre bibliothèque.');
        }

        Bibliotheque::create([
            'user_id' => $user->id,
            'content_id' => $content_id,
            'statut' => $request->statut,
        ]);

        return redirect()->back()->with('message', 'Ajouté à votre bibliothèque avec succès.');
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:en cours,a voir,termine',
        ]);

        $bibliotheque = Bibliotheque::findOrFail($id);
        $bibliotheque->statut = $request->statut;
        $bibliotheque->save();

        return redirect()->route('bibliotheques.index')->with('success', 'Statut du contenu mis à jour.');
    }

    public function destroy($id)
    {
        $bibliotheque = Bibliotheque::findOrFail($id);
        $bibliotheque->delete();

        return redirect()->route('bibliotheques.index')->with('success', 'Contenu supprimé de votre bibliothèque.');
    }


    public function afficherBibliotheque()
{
    $bibliotheque = Bibliotheque::where('user_id', Auth::id())->get();
    return view('bibliotheque.index', compact('bibliotheque'));
}
public function retirer($content_id)
{
    $bibliotheque = Bibliotheque::where('user_id', auth()->id())
        ->where('content_id', $content_id)
        ->first();

    if ($bibliotheque) {
        $bibliotheque->delete();
        return back()->with('message', 'Contenu retiré de la bibliothèque.');
    }

    return back()->with('message', 'Contenu non trouvé dans votre bibliothèque.');
}


}
