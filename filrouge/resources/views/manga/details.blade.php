
<div class="container">
    <h2>Details du Manga</h2>

    <p><strong>Titre :</strong> {{ $manga->content->titre }}</p>
    <p><strong>Description :</strong> {{ $manga->content->description }}</p>
    <p><strong>Genre :</strong> {{ $manga->content->genre }}</p>
    <p><strong>Date de publication :</strong> {{ $manga->content->datePublication }}</p>

    <p><strong>Nombre de chapitres :</strong> {{ $manga->nbr_chapitres }}</p>
    <p><strong>Auteur :</strong> {{ $manga->auteur }}</p>
    <p><strong>Date de début :</strong> {{ $manga->date_debut }}</p>
    <p><strong>Date de fin :</strong> {{ $manga->date_fin }}</p>

    <a href="{{ route('content.index') }}" class="btn btn-secondary">Retour</a>
</div>
