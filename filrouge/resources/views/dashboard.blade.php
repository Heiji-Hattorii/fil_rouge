<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
</head>
<body>

<h1>Bienvenue, {{ Auth::user()->name }}</h1>

<p><strong>Email :</strong> {{ Auth::user()->email }}</p>
<p><strong>Pseudo :</strong> {{ Auth::user()->pseudo }}</p>
<p><strong>Âge :</strong> {{ Auth::user()->age }}</p>
<p><strong>Bio :</strong> {{ Auth::user()->bio }}</p>

@if(Auth::user()->profile_photo)
<img src="{{ asset(Auth::user()->profile_photo) }}" alt="Photo de profil">
@endif

@if(Auth::user()->cover_photo)
<img src="{{ asset(Auth::user()->cover_photo) }}" alt="Photo de couverture">
@endif

<br><br>

<a href="{{ route('profile.edit') }}">Modifier mes informations</a> |
<form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">Déconnexion</button>
</form>
|
<form action="{{ route('profile.delete') }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Supprimer définitivement votre compte ?');" style="background:none; border:none; color:red; cursor:pointer;">Supprimer le compte</button>
</form>

</body>
</html>
