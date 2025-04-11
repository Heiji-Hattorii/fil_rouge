<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
    
        $request->validate([
            'name' => 'required|string|max:255',
            'pseudo' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'age' => 'nullable|integer|min:0',
            'password' => 'nullable|string|confirmed|min:8',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cover_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $user->name = $request->name;
        $user->pseudo = $request->pseudo;
        $user->bio = $request->bio;
        $user->age = $request->age;
    
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
    
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo && file_exists(public_path($user->profile_photo))) {
                unlink(public_path($user->profile_photo));
            }
    
            $profilePhoto = $request->file('profile_photo');
            $profilePhotoName = time() . '_' . $profilePhoto->getClientOriginalName();
            $profilePhoto->move(public_path('profils'), $profilePhotoName);
    
            $user->profile_photo = 'profils/' . $profilePhotoName;
        }
    
        if ($request->hasFile('cover_photo')) {
            if ($user->cover_photo && file_exists(public_path($user->cover_photo))) {
                unlink(public_path($user->cover_photo));
            }
    
            $coverPhoto = $request->file('cover_photo');
            $coverPhotoName = time() . '_' . $coverPhoto->getClientOriginalName();
            $coverPhoto->move(public_path('couvertures'), $coverPhotoName);
    
            $user->cover_photo = 'couvertures/' . $coverPhotoName;
        }
    
        $user->save();
    
        return redirect()->route('dashboard')->with('success', 'Profil mis à jour.');
    }
    

    public function destroy()
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect()->route('login')->with('success', 'Compte supprimé.');
    }
}
