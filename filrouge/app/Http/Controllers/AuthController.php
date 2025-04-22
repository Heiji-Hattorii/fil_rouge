<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'profile_photo' => 'image|mimes:jpg,jpeg,png|max:2048',
            'cover_photo' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'bio' => $request->bio,
            'age' => $request->age,
            'pseudo' => $request->pseudo,
        ]);
    
        $profilePhotoPath = null;
        $coverPhotoPath = null;
    
        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo');
            $profilePhotoName = time() . '_' . $profilePhoto->getClientOriginalName();
            $profilePhoto->move(public_path('profils'), $profilePhotoName);
            $profilePhotoPath = 'profils/' . $profilePhotoName;
        }
    
        if ($request->hasFile('cover_photo')) {
            $coverPhoto = $request->file('cover_photo');
            $coverPhotoName = time() . '_' . $coverPhoto->getClientOriginalName();
            $coverPhoto->move(public_path('couvertures'), $coverPhotoName);
            $coverPhotoPath = 'couvertures/' . $coverPhotoName;
        }
    
        $user->update([
            'profile_photo' => $profilePhotoPath,
            'cover_photo' => $coverPhotoPath,
        ]);
    
        Auth::login($user);
    
        return redirect()->route('dashboard');
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function sendResetPassword(Request $request)
{
    $request->validate(['email' => 'required|email']);
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Aucun utilisateur trouvé avec cet e-mail.']);
    }

    $newPassword = Str::random(10);
    $user->password = Hash::make($newPassword);
    $user->save();

    Mail::to($user->email)->send(new ResetPasswordMail($user->name, $newPassword));

    return back()->with('success', 'Un nouveau mot de passe a été envoyé à votre adresse e-mail.');
}
}
