<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapitre;
use App\Models\Page;
use App\Models\Commentaire;
use App\Models\View;
use Illuminate\Support\Facades\Auth;

class ChapitreController extends Controller
{
    public function index($manga_id)
    {
        $chapitres = Chapitre::where('manga_id', $manga_id)->get();
        return view('manga.chapitres.index', compact('chapitres', 'manga_id'));
    }

    public function create($manga_id)
    {
        return view('manga.chapitres.create', compact('manga_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nbr_pages' => 'required|integer',
            'date_ajout' => 'required|date',
            'manga_id' => 'required|exists:mangas,id',
        ]);

        Chapitre::create($request->all());

        return redirect()->route('manga.chapitres.index', ['manga_id' => $request->manga_id])
            ->with('success', 'Chapitre ajouté avec succès.');
    }

    public function show($id)
    {
        $chapitre = Chapitre::findOrFail($id);
        $pages = Page::where('chapitre_id', $chapitre->id)->get();
        $comments = Commentaire::where('chapitre_id', $id)->orderBy('created_at', 'desc')->get();

        $deja_ajoute = false;
        if (auth()->check()) {
            $deja_ajoute = auth()->user()->vues()->where('chapitre_id', $id)->exists();
        }

        return view('manga.chapitres.show', compact('chapitre', 'comments', 'deja_ajoute','pages'));
    }

    public function edit($id)
    {
        $chapitre = Chapitre::findOrFail($id);
        return view('manga.chapitres.index', ['editChapitre' => $chapitre, 'manga_id' => $chapitre->manga_id, 'chapitres' => Chapitre::where('manga_id', $chapitre->manga_id)->get()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nbr_pages' => 'required|integer',
            'date_ajout' => 'required|date',
        ]);

        $chapitre = Chapitre::findOrFail($id);
        $chapitre->update($request->all());

        return redirect()->route('manga.chapitres.index', ['manga_id' => $chapitre->manga_id])
            ->with('success', 'Chapitre mis à jour.');
    }

    public function destroy($id)
    {
        $chapitre = Chapitre::findOrFail($id);
        $manga_id = $chapitre->manga_id;
        $chapitre->delete();

        return redirect()->route('manga.chapitres.index', ['manga_id' => $manga_id])
            ->with('success', 'Chapitre supprimé.');
    }
    public function addView($id)
    {
        $chapitre = Chapitre::findOrFail($id);
        if (Auth::check()) {
            View::firstOrCreate([
                'user_id' => Auth::id(),
                'chapitre_id' => $chapitre->id,
            ]);
        }
        return redirect()->route('manga.chapitres.show', $chapitre->id);
    }

    public function removeView($id)
    {
        $chapitre = Chapitre::find($id);

        if (!$chapitre) {
            return redirect()->back()->with('error', 'Chapitre introuvable');
        }

        $view = View::where('user_id', auth()->id())
            ->where('chapitre_id', $chapitre->id)
            ->first();

        if ($view) {
            $view->delete();
            return redirect()->route('manga.chapitres.show', $chapitre->id)->with('success', 'Chapitre retiré de vos vues');
        }

        return redirect()->route('manga.chapitres.show', $chapitre->id)->with('error', 'Chapitre non trouvé dans vos vues');
    }


}
