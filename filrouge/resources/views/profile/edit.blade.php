<h2>Modifier mon profil</h2>

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Nom :</label>
    <input type="text" name="name" value="{{ $user->name }}"><br>

    <label>Pseudo :</label>
    <input type="text" name="pseudo" value="{{ $user->pseudo }}"><br>

    <label>Bio :</label>
    <textarea name="bio">{{ $user->bio }}</textarea><br>

    <label>Âge :</label>
    <input type="number" name="age" value="{{ $user->age }}"><br>

    <label>Photo de profil :</label>
    <input type="file" name="profile_photo"><br>

    <label>Photo de couverture :</label>
    <input type="file" name="cover_photo"><br>

    <label>Nouveau mot de passe :</label>
    <input type="password" name="password"><br>

    <label>Confirmer le mot de passe :</label>
    <input type="password" name="password_confirmation"><br>

    <button type="submit">Enregistrer</button>
</form>
