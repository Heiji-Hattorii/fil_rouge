
    <h2>Détails du Chapitre</h2>

    <div>ID : {{ $chapitre->id }}</div>
    <div>Nombre de pages : {{ $chapitre->nbr_pages }}</div>
    <div>Date d'ajout : {{ $chapitre->date_ajout }}</div>

    <a href="{{ route('manga.chapitres.index', ['manga_id' => $chapitre->manga_id]) }}" class="btn btn-secondary">Retour</a>
