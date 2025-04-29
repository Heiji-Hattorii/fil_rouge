@include('partials.header')
<form action="{{ route('anime.store') }}" method="POST">
    @csrf
    <input type="hidden" name="content_id" value="{{ $content_id }}">
    <input type="number" name="nbr_episodes" placeholder="Nombre d’épisodes" required>
    <input type="number" name="nbr_saisons" placeholder="Nombre de saisons" required>
    <input type="date" name="date_debut" required>
    <input type="date" name="date_fin" required>
    <input type="text" name="producteur" placeholder="Producteur" required>
    <button type="submit">Enregistrer Anime</button>
</form>
