<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Category::create([
            'nom' => $request->nom,
        ]);

        return redirect()->route('category.index')->with('success', 'Catégorie ajoutée avec succès.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'nom' => $request->nom,
        ]);

        return redirect()->route('category.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}
