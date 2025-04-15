 <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="name">Nom :</label>
    <input type="text" name="name" required>
    
    <label for="email">Email :</label>
    <input type="email" name="email" required>
    
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required>
    
    <label for="password_confirmation">Confirmer le mot de passe :</label>
    <input type="password" name="password_confirmation" required>
    
    <label for="bio">Biographie :</label>
    <textarea name="bio" required></textarea>
    
    <label for="age">Âge :</label>
    <input type="number" name="age" required>
    
    <label for="profile_photo">Photo de profil :</label>
    <input type="file" name="profile_photo" required>
    
    <label for="cover_photo">Photo de couverture :</label>
    <input type="file" name="cover_photo" required>
    
    <label for="pseudo">Pseudo :</label>
    <input type="text" name="pseudo" required>
    &
    <button type="submit">S'inscrire</button>
</form> 

