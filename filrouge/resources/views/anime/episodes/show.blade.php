<div class="container">
    <h1>episode {{ $episode->numero_episode }}</h1>
    <p><strong>Contenu :</strong></p>
    <video width="640" height="360" controls>
        <source src="{{ asset($episode->contenu) }}" type="video/mp4">
        Non supporté
    </video>
    <p><strong>Date d'ajout :</strong> {{ $episode->date_ajout }}</p>
    <a href="{{ route('anime.episodes.index', $episode->anime_id) }}" class="btn btn-secondary">Retour</a>
</div>


<form method="POST" action="{{ $dejaAjoute ? route('episode.removeView', [$episode->anime_id, $episode->id]) : route('episode.addView', [$episode->anime_id, $episode->id]) }}">
    @csrf
    <button type="submit" class="btn btn-primary">
        {{ $dejaAjoute ? 'Retirer de mes vues' : 'Ajouter à mes vues' }}
    </button>
</form>
<div class="mt-8">
    <h2 class="text-2xl font-bold mb-4">Commentaires</h2>

    @if ($comments->isEmpty())
        <p>Aucun commentaire pour ce episode pour l'instant.</p>
    @else
        <div class="space-y-4">
            @foreach ($comments as $comment)
                <div class="border p-4 rounded-md shadow-sm">
                    <p class="text-gray-700">{{ $comment->comment }}</p>
                    <p class="text-sm text-gray-500 mt-2">Posté le {{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y à H:i') }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>

<div class="mt-8">
    <h3 class="text-xl font-semibold">Ajouter un commentaire</h3>
    <form method="POST" action="{{ route('commentaire.store') }}">
        @csrf
        <input type="hidden" name="content_id" value="{{ $episode->anime->content_id }}">
        <input type="hidden" name="episode_id" value="{{ $episode->id }}">
        <textarea name="comment" placeholder="Votre commentaire..." required class="w-full border p-2 rounded-md mt-2"></textarea>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md mt-4">Envoyer</button>
    </form>
</div>
