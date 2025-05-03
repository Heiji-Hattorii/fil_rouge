<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user', 
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role, 
        ]);
    
        return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès.');
    }
    
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,user', 
        ]);
    
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role,
        ]);
    
        return redirect()->route('users.index')->with('success', 'Utilisateur modifié avec succès.');
    }
    

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function statistics()
    {
            $totalUsers = User::count();
    
            $totalAnimes = Content::where('type', 'anime')->count();
    
            $totalMangas = Content::where('type', 'manga')->count();
            $categories = Category::withCount([
                'contents as animes_count' => function ($query) {
                    $query->where('type', 'anime');
                },
                'contents as mangas_count' => function ($query) {
                    $query->where('type', 'manga');
                }
            ])->get();
            return view('statistics', compact('totalUsers', 'totalAnimes', 'totalMangas', 'categories'));
        }
}
