<h2>Détails du Chapitre</h2>

<div>ID : {{ $chapitre->id }}</div>
<div>Nombre de pages : {{ $chapitre->nbr_pages }}</div>
<div>Date d'ajout : {{ $chapitre->date_ajout }}</div>

<a href="{{ route('manga.chapitres.index', ['manga_id' => $chapitre->manga_id]) }}" class="btn btn-secondary">Retour</a>

<hr>

<h3>Commentaires :</h3>
@if($comments->isEmpty())
    <p>Aucun commentaire pour ce chapitre.</p>
@else
    <ul>
        @foreach($comments as $comment)
            <li>
                <strong>{{ $comment->user->name }} :</strong>
                <p>{{ $comment->comment }}</p>
                <small>Posté le : {{ $comment->created_at->format('d/m/Y H:i:s') }}</small>
            </li>
        @endforeach
    </ul>
@endif

<h3>Ajouter un commentaire :</h3>
<form action="{{ route('commentaire.store') }}" method="POST">
    @csrf
    <input type="hidden" name="content_id" value="{{ $chapitre->manga->content_id }}">
    <input type="hidden" name="chapitre_id" value="{{ $chapitre->id }}">
    <textarea name="comment" placeholder="Votre commentaire..." required></textarea>
    <div>
        <button type="submit">Envoyer</button>
    </div>
</form>
