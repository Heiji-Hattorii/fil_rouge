    <h2 class="text-xl font-bold">Recommandations basées sur votre bibliothèque</h2>

    @if($recommandations->isEmpty())
        <p>Aucune recommandation pour l’instant.</p>
    @else
        @foreach($recommandations as $content)
            <div class="border p-4 rounded my-2">
                <h3 class="text-lg font-semibold">{{ $content->titre }}</h3>
                <p>{{ $content->description }}</p>
                <p>Type : {{ $content->type }}</p>
                <p>Catégorie : {{ $content->category->nom ?? 'N/A' }}</p>
                <form action="{{ route('bibliotheque.ajouter', ['content_id' => $content->id]) }}" method="POST">
                    @csrf
                    <select name="statut" required>
                        <option value="en cours">En cours</option>
                        <option value="a voir">À voir</option>
                        <option value="termine">Terminé</option>
                    </select>
                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded mt-2">Ajouter</button>
                </form>
            </div>
        @endforeach
    @endif
