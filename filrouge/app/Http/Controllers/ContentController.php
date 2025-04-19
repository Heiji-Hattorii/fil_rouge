<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Category;
class ContentController extends Controller
{
    public function index(){
        $contents = Content::all();
        $categories = Category::all();
        return view('content.index', compact('contents', 'categories'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'titre' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|in:anime,manga',
            'category_id' => 'required|exists:categories,id',
            'datePublication' => 'required|date',
        ]);

        $content = Content::create($validated);
        // return redirect()->route('content.index');
        
        if ($content->type === 'anime') {
            return redirect()->route('anime.create', ['content_id' => $content->id]);
        } 
        else {
            return redirect()->route('manga.create', ['content_id' => $content->id]);
        }
    }


    public function show($id){
        $content = Content::with('category')->findOrFail($id);

        // $content = Content::findOrFail($id);
        return view('content.details', compact('content'));}

    
    public function update(Request $request){
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
            'datePublication' =>$request->MdatePublication,
        ]);
        return redirect()->route('content.index');}


    public function destroy(Request $request){
        $content = Content::findOrFail($request->DID);
        $content->delete();
        return redirect()->route('content.index');}
}
