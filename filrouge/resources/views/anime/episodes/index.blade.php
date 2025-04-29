@include('partials.header')

<div class="container">
    <h1>Épisodes de {{ $anime->content->titre }}</h1>

    <form action="{{ route('anime.episodes.store', ['anime_id' => $anime->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="mb-3">
            <label for="numero_episode" class="form-label">Numéro de l'épisode</label>
            <input type="number" name="numero_episode" class="form-control" required>
        </div>
        <div class="mb-3">
        <label for="contenu" class="form-label">Vidéo</label>
        <input type="file" name="contenu" class="form-control" accept="video/*" required>
    </div>
        <div class="mb-3">
            <label for="date_ajout" class="form-label">Date d'ajout</label>
            <input type="date" name="date_ajout" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif


    <hr>

    <h1>Épisodes de {{ $anime->content->titre }}</h1>

@if($episodes->isEmpty())
    <p>Aucun épisode trouvé.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Contenu</th>
                <th>Date d'ajout</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($episodes as $episode)
                <tr>
                    <td>{{ $episode->numero_episode }}</td>
                    <td>
                        <video width="200" controls>
                            <source src="{{ asset($episode->contenu) }}" type="video/mp4">
                            Non supporté
                        </video>
                    </td>
                    <td>{{ $episode->date_ajout }}</td>
                    <td>
                        <button onclick="openEpisodeModal({{ $episode->id }}, {{ $episode->numero_episode }}, '{{ asset($episode->contenu) }}', '{{ $episode->date_ajout }}', {{ $anime->id }})" class="btn btn-warning">
    Modifier
</button>
                        <a href="{{route('anime.episodes.show', ['anime_id' => $anime->id, 'id' => $episode->id]) }}" class="btn btn-warning">
    Voir episode
</a>


                        <form action="{{ route('anime.episodes.destroy', ['anime_id' => $anime->id, 'id' => $episode->id]) }}" method="POST" style="display:inline-block;">
                        @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<div id="episodeModal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
     background:white; padding:20px; border:1px solid #ccc; z-index:1000;">
    <h2>Modifier l’épisode</h2>
    <form id="episodeForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label>Numéro de l'épisode :</label>
        <input type="number" name="numero_episode" id="numero_episode" required><br>

        <label>Vidéo actuelle :</label><br>
        <video width="200" controls id="current_video">
            <source src="" type="video/mp4">
        </video><br><br>

        <label>Changer la vidéo (optionnel) :</label>
        <input type="file" name="contenu" accept="video/*"><br><br>

        <label>Date d'ajout :</label>
        <input type="date" name="date_ajout" id="date_ajout" required><br><br>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <button type="button" onclick="closeEpisodeModal()" class="btn btn-secondary">Annuler</button>
    </form>
</div>

<div id="episodeOverlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
     background:rgba(0,0,0,0.5); z-index:999;" onclick="closeEpisodeModal()"></div>

<script>
function openEpisodeModal(id, numero, videoUrl, dateAjout, animeId) {
    document.getElementById('numero_episode').value = numero;
    document.getElementById('current_video').src = videoUrl;
    document.getElementById('date_ajout').value = dateAjout;
    document.getElementById('episodeForm').action = `/anime/${animeId}/episodes/${id}`;
    document.getElementById('episodeModal').style.display = 'block';
    document.getElementById('episodeOverlay').style.display = 'block';
}


function closeEpisodeModal() {
    document.getElementById('episodeModal').style.display = 'none';
    document.getElementById('episodeOverlay').style.display = 'none';
}
</script>
