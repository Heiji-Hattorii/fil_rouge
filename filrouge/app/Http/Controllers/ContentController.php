<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;

class ContentController extends Controller
{
    public function index(){
        $allcontent = Content::all();
        return view('content.index', compact('allcontent'));}


    public function store(Request $request){
        $validated = $request->validate([
            'titre' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|in:anime,manga',
            'genre' => 'required|string',
            'datePublication' => 'required|date',
        ]);

        $content = Content::create($validated);
        return redirect()->route('content.index');}


    public function show($id){
        $content = Content::findOrFail($id);
        return view('content.details', compact('content'));}

    
    public function update(Request $request){
        $content = Content::findOrFail($request->MID);
        $request->validate([
            'Mtitre' => 'required|string',
            'Mdescription' => 'required|string',
            'Mtype' => 'required|in:anime,manga',
            'Mgenre' => 'required|string',
            'MdatePublication' => 'required|date',
        ]);
        $content->update([
            'titre' => $request->Mtitre,
            'description' => $request->Mdescription,
            'type' => $request->Mtype,
            'genre' => $request->Mgenre,
            'datePublication' =>$request->MdatePublication,
        ]);
        return redirect()->route('content.index');}

        
    public function destroy(Request $request){
        $content = Content::findOrFail($request->DID);
        $content->delete();
        return redirect()->route('content.index');}
}
