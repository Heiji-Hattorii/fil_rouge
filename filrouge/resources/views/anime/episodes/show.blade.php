
<div class="container">
    <h1>Épisode {{ $episode->numero_episode }}</h1>
    <p><strong>Contenu :</strong></p>
    <video width="640" height="360" controls>
    <source src="{{ asset($episode->contenu) }}" type="video/mp4">
                            Non supporté
                        </video>
    <p><strong>Date d'ajout :</strong> {{ $episode->date_ajout }}</p>
    <a href="{{ route('anime.episodes.index', $episode->anime_id) }}" class="btn btn-secondary">Retour</a>
</div>
