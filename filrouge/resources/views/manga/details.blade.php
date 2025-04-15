<!-- CDN de Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">Détails du Manga</h2>

    <p><strong>Titre :</strong> {{ $manga->content->titre }}</p>
    <p><strong>Description :</strong> {{ $manga->content->description }}</p>
    <p><strong>Genre :</strong> {{ $manga->content->genre }}</p>
    <p><strong>Date de publication :</strong> {{ $manga->content->datePublication }}</p>

    <p><strong>Nombre de chapitres :</strong> {{ $manga->nbr_chapitres }}</p>
    <p><strong>Auteur :</strong> {{ $manga->auteur }}</p>
    <p><strong>Date de début :</strong> {{ $manga->date_debut }}</p>
    <p><strong>Date de fin :</strong> {{ $manga->date_fin }}</p>

    <p class="mt-4"><strong>Note moyenne :</strong> {{ $averageRating ?? 'Pas encore noté' }}</p>

    <div class="flex space-x-1 mb-4">
        @for ($i = 1; $i <= 5; $i++)
            <span class="star text-3xl {{ $i <= ($averageRating ?? 0) ? 'text-yellow-500' : 'text-gray-300' }}">&#9733;</span>
        @endfor
    </div>

    @if(Auth::check())
    <form action="{{ route('notation.store', ['contentId' => $manga->content->id]) }}" method="POST" class="space-y-4" onsubmit="return validateRating()">
        @csrf
        <label for="note" class="block text-lg">Donner une note (1 à 5) :</label>
        <div class="flex space-x-1">
            @for ($i = 1; $i <= 5; $i++)
                <span class="star-form text-3xl cursor-pointer text-gray-300 hover:text-yellow-500" data-value="{{ $i }}" onclick="setRating(this, {{ $i }})">&#9733;</span>
            @endfor
        </div>
        <input type="hidden" name="note" id="note" value="0" />
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md mt-4 hover:bg-blue-600">
            Soumettre
        </button>
    </form>
    @endif

    <div class="mt-6">
        <h3 class="text-xl font-semibold mb-4">Commentaires :</h3>

        @foreach($comments as $comment)
            <div class="border-b mb-4 pb-4">
                <p><strong>{{ $comment->user->name }}</strong> a dit :</p>
                <p>{{ $comment->comment }}</p>
                <p class="text-sm text-gray-500">{{ $comment->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
        @endforeach

        @if(Auth::check())
        <form action="{{ route('commentaire.store', ['content_id' => $manga->content->id]) }}" method="POST" class="space-y-4 mt-6">
            @csrf
            <label for="commentaire" class="block text-lg">Ajouter un commentaire :</label>
            <textarea name="comment" id="commentaire" rows="4" class="w-full p-2 border rounded-md" required></textarea>
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md mt-4 hover:bg-green-600">
                Ajouter le commentaire
            </button>
        </form>
        @endif
    </div>

    <div class="flex space-x-4 mt-6">
        <a href="{{ route('manga.chapitres.index', ['manga_id' => $manga->id]) }}" class="btn btn-primary bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Voir les Chapitres</a>
        <a href="{{ route('content.index') }}" class="btn btn-secondary bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Retour</a>
    </div>
</div>

<script>
    function setRating(starElement, value) {
        document.getElementById('note').value = value;

        const stars = document.querySelectorAll('.star-form');
        stars.forEach(star => {
            if (parseInt(star.getAttribute('data-value')) <= value) {
                star.classList.add('text-yellow-500');
                star.classList.remove('text-gray-300');
            } else {
                star.classList.remove('text-yellow-500');
                star.classList.add('text-gray-300');
            }
        });
    }

    function validateRating() {
        const rating = document.getElementById('note').value;
        if (rating == 0) {
            alert('Veuillez sélectionner une note entre 1 et 5.');
            return false; 
        }
        return true; 
    }
</script>
