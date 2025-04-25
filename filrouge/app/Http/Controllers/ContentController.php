<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Category;
use App\Models\Bibliotheque;
class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::all();
        $categories = Category::all();
        $bibliothequeIds = [];

        if (auth()->check()) {
            $user = auth()->user();
            $bibliothequeIds = $user->bibliotheques->pluck('content_id')->toArray();
        }
        return view('content.index', compact('contents', 'categories','bibliothequeIds'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|in:anime,manga',
            'category_id' => 'required|exists:categories,id',
            'datePublication' => 'required|date',
            'photo' => 'image|mimes:jpg,png,jpeg,gif,webp',

        ]);
        if ($request->hasFile('photo')) {
            $filename = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('contents'), $filename);
            $validated['photo'] = 'contents/' . $filename;
        }
    
        $content = Content::create($validated);
        // return redirect()->route('content.index');

        if ($content->type === 'anime') {
            return redirect()->route('anime.create', ['content_id' => $content->id]);
        } else {
            return redirect()->route('manga.create', ['content_id' => $content->id]);
        }
    }


    public function show($id)
    {
        $content = Content::with('category')->findOrFail($id);

        // $content = Content::findOrFail($id);
        return view('content.details', compact('content'));
    }


    public function update(Request $request)
    {
        $content = Content::findOrFail($request->MID);
        $request->validate([
            'Mtitre' => 'required|string',
            'Mdescription' => 'required|string',
            'Mtype' => 'required|in:anime,manga',
            'Mcategory_id' => 'required|exists:categories,id',
            'MdatePublication' => 'required|date',
        ]);
        $content->update([
            'titre' => $request->Mtitre,
            'description' => $request->Mdescription,
            'type' => $request->Mtype,
            'category_id' => $request->Mcategory_id,
            'datePublication' => $request->MdatePublication,
        ]);
        return redirect()->route('content.index');
    }


    public function destroy(Request $request)
    {
        $content = Content::findOrFail($request->DID);
        $content->delete();
        return redirect()->route('content.index');
    }

    public function recommandations()
    {
        $user = auth()->user();

        $categoryIds = Bibliotheque::where('user_id', $user->id)
            ->with('content')
            ->get()
            ->pluck('content.category_id')
            ->unique();

        $alreadyAddedIds = Bibliotheque::where('user_id', $user->id)->pluck('content_id');

        $recommandations = Content::whereIn('category_id', $categoryIds)
            ->whereNotIn('id', $alreadyAddedIds)
            ->get();

        return view('content.recommandations', compact('recommandations'));
    }


    public function filter(Request $request)
    {
        $query = Content::query();
    
        if ($request->filled('titre')) {
            $query->where('titre', 'like', '%' . $request->titre . '%');
        }
    
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
    
        if ($request->filled('annee')) {
            $query->whereYear('datePublication', $request->annee);
        }
        $contents = $query->get();
        $categories = Category::all();
        $bibliothequeIds = [];
    
        if (auth()->check()) {
            $user = auth()->user();
            $bibliothequeIds = $user->bibliotheques->pluck('content_id')->toArray();
        }
    
        return view('content.index', compact('contents', 'categories', 'bibliothequeIds'));
    }
        


}
