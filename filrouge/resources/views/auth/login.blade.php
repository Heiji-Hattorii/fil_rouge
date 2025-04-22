<form action="{{ route('login') }}" method="POST">
    @csrf
    <label for="email">Email :</label>
    <input type="email" name="email" required>
    
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required>
    
    <button type="submit">Se connecter</button>
</form>

<div style="margin: 8px 0;">
    <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
</div>