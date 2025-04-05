
    <h1>Ajouter un Chapitre</h1>

    <form action="{{ route('chapitre.store') }}" method="POST">
        @csrf
        <input type="hidden" name="manga_id" value="{{ $manga_id }}">

        <div class="mb-3">
            <label for="nbr_pages" class="form-label">Nombre de Pages</label>
            <input type="number" name="nbr_pages" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="date_ajout" class="form-label">Date d'Ajout</label>
            <input type="date" name="date_ajout" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
