<script src="https://cdn.tailwindcss.com"></script>

@include('partials.header')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-4">Détails du Chapitre</h2>

    <div class="mb-4">
        <div>ID : <span class="font-semibold">{{ $chapitre->id }}</span></div>
        <div>Nombre de pages : <span class="font-semibold">{{ $chapitre->nbr_pages }}</span></div>
        <div>Date d'ajout : <span class="font-semibold">{{ $chapitre->date_ajout }}</span></div>
    </div>

<form method="POST" action="{{ $deja_ajoute ? route('chapitre.removeView', $chapitre->id) : route('chapitre.addView', $chapitre->id) }}">
    @csrf
    <button type="submit" class="px-4 py-2 rounded-md {{ $deja_ajoute ? 'bg-red-500 text-white' : 'bg-blue-500 text-white' }}">
        {{ $deja_ajoute ? 'Retirer de mes vues' : 'Ajouter à mes vues' }}
    </button>
</form>


    <a href="{{ route('manga.chapitres.index', ['manga_id' => $chapitre->manga_id]) }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded-md">Retour</a>

    <hr class="my-4">

    <h3 class="text-xl font-semibold">Commentaires :</h3>
    @if($comments->isEmpty())
        <p>Aucun commentaire pour ce chapitre.</p>
    @else
        <ul class="space-y-4">
            @foreach($comments as $comment)
                <li class="border p-4 rounded-md shadow-sm">
                    <strong>{{ $comment->user->name }} :</strong>
                    <p>{{ $comment->comment }}</p>
                    <small class="text-gray-500">Posté le : {{ $comment->created_at->format('d/m/Y H:i:s') }}</small>
                </li>
            @endforeach
        </ul>
    @endif

    <h3 class="text-xl font-semibold mt-6">Ajouter un commentaire :</h3>
    <form action="{{ route('commentaire.store') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="content_id" value="{{ $chapitre->manga->content_id }}">
        <input type="hidden" name="chapitre_id" value="{{ $chapitre->id }}">
        <textarea name="comment" placeholder="Votre commentaire..." required class="w-full border p-2 rounded-md"></textarea>
        <div class="mt-4">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Envoyer</button>
        </div>
    </form>
</div>
