<script src="https://cdn.tailwindcss.com"></script>
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Détails de l'anime</h2>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-xl font-semibold mb-2">{{ $anime->content->titre }}</h3>
        <p class="text-gray-700 mb-2"><strong>Description :</strong> {{ $anime->content->description }}</p>
        <p class="text-gray-700 mb-2"><strong>Date de publication :</strong> {{ $anime->content->datePublication }}</p>
        <p class="text-gray-700 mb-2"><strong>Type :</strong> {{ $anime->content->type }}</p>
        <p class="text-gray-700 mb-2"><strong>Genre :</strong> {{ $anime->content->genre }}</p>

        <p class="text-gray-700 mb-2"><strong>Nombre d'épisodes :</strong> {{ $anime->nbr_episodes }}</p>
        <p class="text-gray-700 mb-2"><strong>Nombre de saisons :</strong> {{ $anime->nbr_saisons }}</p>
        <p class="text-gray-700 mb-2"><strong>Date de début :</strong> {{ $anime->date_debut }}</p>
        <p class="text-gray-700 mb-2"><strong>Date de fin :</strong> {{ $anime->date_fin }}</p>
        <p class="text-gray-700 mb-4"><strong>Producteur :</strong> {{ $anime->producteur }}</p>

        <p class="mt-4"><strong>Note moyenne :</strong> {{ $averageRating ?? 'Pas encore noté' }}</p>

        <div class="flex space-x-1 mb-4">
            @for ($i = 1; $i <= 5; $i++)
                <span class="star text-3xl {{ $i <= ($averageRating ?? 0) ? 'text-yellow-500' : 'text-gray-300' }}">&#9733;</span>
            @endfor
        </div>

        @if(Auth::check())
        <form action="{{ route('notation.store', ['contentId' => $anime->content->id]) }}" method="POST" class="space-y-4" onsubmit="return validateRating()">
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

        <h4 class="mt-6 text-xl font-semibold">Commentaires</h4>
        <div class="mt-4">
            @foreach($comments as $comment)
                <div class="bg-gray-100 p-4 rounded-lg mb-4">
                    <p><strong>{{ $comment->user->name }} :</strong> {{ $comment->comment }}</p>
                    <p class="text-sm text-gray-500">Posté le {{ $comment->created_at->format('d/m/Y H:i') }}</p>
                </div>
            @endforeach
        </div>

        @if(Auth::check())
        <form action="{{ route('commentaire.store') }}" method="POST">
            @csrf
            <input type="hidden" name="content_id" value="{{ $anime->content->id }}">
            <div class="mb-4">
                <label for="comment" class="block text-lg font-semibold">Laissez un commentaire :</label>
                <textarea id="comment" name="comment" class="w-full p-2 border border-gray-300 rounded-md" required></textarea>
            </div>
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">
                Soumettre le commentaire
            </button>
        </form>
        @endif

        <div class="flex space-x-4 mt-6">
            <a href="{{ route('content.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                Revenir
            </a>
            <a href="{{ route('anime.episodes.index', ['anime_id' => $anime->id]) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Consulter épisodes
            </a>
        </div>
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
