@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

@if($errors->any())
    <p style="color: red">{{ $errors->first() }}</p>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <label for="email">Adresse e-mail :</label>
    <input type="email" name="email" required>
    <button type="submit">Envoyer un nouveau mot de passe</button>
</form>
