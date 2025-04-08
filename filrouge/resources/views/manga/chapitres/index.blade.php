
    <h1>Chapitres</h1>

    <form action="{{ isset($editChapitre) ? route('manga.chapitres.update', $editChapitre->id) : route('manga.chapitres.store') }}" method="POST">
        @csrf
        @if(isset($editChapitre))
            @method('PUT')
        @endif

        <input type="hidden" name="manga_id" value="{{ $manga_id }}">
        <input type="number" name="nbr_pages" placeholder="Nombre de pages" value="{{ $editChapitre->nbr_pages ?? '' }}" required>
        <input type="date" name="date_ajout" value="{{ $editChapitre->date_ajout ?? '' }}" required>
        <button type="submit" class="btn btn-success">{{ isset($editChapitre) ? 'Mettre à jour' : 'Ajouter' }}</button>
    </form>

    <hr>

    @if($chapitres->isEmpty())
        <p>Aucun chapitre trouvé.</p>
    @else
        <table class="table">
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
                            <a href="{{ route('manga.chapitres.show', $chapitre->id) }}" class="btn btn-info">Voir</a>
                            <a href="{{ route('manga.chapitres.edit', $chapitre->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('manga.chapitres.destroy', $chapitre->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                            <a href="{{ route('manga.pages.create', ['chapitre_id' => $chapitre->id]) }}" class="btn btn-primary">Ajouter des pages</a>
                            <a href="{{ route('manga.chapitres.pages.show', ['chapitre_id' => $chapitre->id]) }}" class="btn btn-primary">Voir Tout les pages</a>
                            </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    @endif


    <a href="{{ route('content.index') }}" class="btn btn-secondary">Retour</a>
