
    <h1>Modifier le Chapitre</h1>

    <form action="{{ route('chapitre.update', $chapitre->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nbr_pages" class="form-label">Nombre de Pages</label>
            <input type="number" name="nbr_pages" class="form-control" value="{{ $chapitre->nbr_pages }}" required>
        </div>

        <div class="mb-3">
            <label for="date_ajout" class="form-label">Date d'Ajout</label>
            <input type="date" name="date_ajout" class="form-control" value="{{ $chapitre->date_ajout->format('Y-m-d') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à Jour</button>
    </form>
