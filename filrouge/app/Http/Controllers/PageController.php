<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Chapitre;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function create($chapitre_id)
    {
        $chapitre = Chapitre::findOrFail($chapitre_id);
        $pages = $chapitre->pages()->orderBy('numero_page')->get();

        return view('manga.chapitres.pages.create', compact('chapitre', 'pages'));
    }

    public function index($chapitre_id)
    {
        $chapitre = Chapitre::findOrFail($chapitre_id);
        $pages = $chapitre->pages()->orderBy('numero_page')->get();
    
        return view('manga.chapitres.pages.index', compact('chapitre', 'pages'));
    }
    public function showall($chapitre_id)
    {
        $chapitre = Chapitre::findOrFail($chapitre_id);
        $pages = $chapitre->pages()->orderBy('numero_page')->get();
    
        return view('manga.chapitres.pages.show', compact('chapitre', 'pages'));
    }
    

    public function store(Request $request, $chapitre_id)
    {
        $request->validate([
            'pages.*' => 'required|image|mimes:jpeg,png,jpg',
            'numero_page' => 'required|integer|min:1'
        ]);
    
        foreach ($request->file('pages') as $image) {
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    
            $destinationPath = public_path('chapitre_pages');
            $image->move($destinationPath, $filename);
    
            Page::create([
                'chapitre_id' => $chapitre_id,
                'numero_page' => $request->numero_page,
                'contenu' => 'chapitre_pages/' . $filename,
            ]);
        }
        return redirect()->route('manga.chapitres.pages.show', $chapitre_id)->with('success', 'Pages ajoutées avec succès.');
    }
    


    public function show($id)
    {
        $page = Page::findOrFail($id);
        return view('manga.chapitres.pages.show', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
    
        $request->validate([
            'numero_page' => 'required|integer|min:1',
            'contenu' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);
    
        $page->numero_page = $request->numero_page;
    
        if ($request->hasFile('contenu')) {
            if (file_exists(public_path($page->contenu))) {
                unlink(public_path($page->contenu));
            }
    
            $image = $request->file('contenu');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('chapitre_pages');
            $image->move($destinationPath, $filename);
            $page->contenu = 'chapitre_pages/' . $filename;
        }
    
        $page->save();
    
        return redirect()->route('manga.chapitres.pages.show', $page->chapitre_id)->with('success', 'Page mise à jour avec succès.');
    }
    
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
    
        if (file_exists(public_path($page->contenu))) {
            unlink(public_path($page->contenu));
        }
    
        $chapitre_id = $page->chapitre_id;
        $page->delete();
    
        return redirect()->route('manga.chapitres.pages.show', $chapitre_id)->with('success', 'Page supprimée avec succès.');
    }
    
}
