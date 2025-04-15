<script src="https://cdn.tailwindcss.com"></script>
<h1>Chapitres</h1>

<form
    action="{{ isset($editChapitre) ? route('manga.chapitres.update', $editChapitre->id) : route('manga.chapitres.store') }}"
    method="POST">
    @csrf
    @if(isset($editChapitre))
        @method('PUT')
    @endif

    <input type="hidden" name="manga_id" value="{{ $manga_id }}">
    <input type="number" name="nbr_pages" placeholder="Nombre de pages" value="{{ $editChapitre->nbr_pages ?? '' }}"
        required>
    <input type="date" name="date_ajout" value="{{ $editChapitre->date_ajout ?? '' }}" required>
    <button type="submit">{{ isset($editChapitre) ? 'Mettre à jour' : 'Ajouter' }}</button>
</form>

<hr>

@if($chapitres->isEmpty())
    <p>Aucun chapitre trouvé.</p>
@else
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pages</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chapitres as $chapitre)
                <tr>
                    <td>{{ $chapitre->id }}</td>
                    <td>{{ $chapitre->nbr_pages }}</td>
                    <td>{{ $chapitre->date_ajout }}</td>
                    <td>
                        <a href="{{ route('manga.chapitres.show', $chapitre->id) }}">Voir</a>
                        <a href="{{ route('manga.chapitres.edit', $chapitre->id) }}">Modifier</a>
                        <form action="{{ route('manga.chapitres.destroy', $chapitre->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                        <a href="{{ route('manga.pages.create', ['chapitre_id' => $chapitre->id]) }}">Ajouter des pages</a>
                        <a href="{{ route('manga.chapitres.pages.show', ['chapitre_id' => $chapitre->id]) }}">Voir Tout les
                            pages</a>

                        <button onclick="ouvrirCommentaireModal({{ $chapitre->manga->content_id }}, {{ $chapitre->id }}, null)">
                            Commenter
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<a href="{{ route('content.index') }}">Retour</a>

<div id="commentModal" class="hidden">
    <div>
        <form method="POST" action="{{ route('commentaire.store') }}">
            @csrf
            <input type="hidden" name="content_id" id="commentContentId">
            <input type="hidden" name="chapitre_id" id="commentChapitreId">
            <input type="hidden" name="episode_id" id="commentEpisodeId">
            <textarea name="comment" placeholder="Votre commentaire..." required></textarea>
            <div>
                <button type="submit">Envoyer</button>
                <button type="button" onclick="fermerCommentaireModal()">Annuler</button>
            </div>
        </form>

        <hr>


    </div>
</div>

<script>
    function ouvrirCommentaireModal(contentId = null, chapitreId = null, episodeId = null) {
        document.getElementById('commentContentId').value = contentId ?? '';
        document.getElementById('commentChapitreId').value = chapitreId ?? '';
        document.getElementById('commentEpisodeId').value = episodeId ?? '';
        document.getElementById('commentModal').classList.remove('hidden');
    }
    function fermerCommentaireModal() {
        document.getElementById('commentModal').classList.add('hidden');
    }
</script>