@include('partials.header')
<div class="container">
    <h2>Ajouter un Manga</h2>
    <form method="POST" action="{{ route('manga.store') }}">
        @csrf
        <input type="hidden" name="content_id" value="{{ $content_id }}">

        <div class="form-group">
            <label for="nbr_chapitres">Nombre de chapitres</label>
            <input type="number" name="nbr_chapitres" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="auteur">Auteur</label>
            <input type="text" name="auteur" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="date_debut">Date de début</label>
            <input type="date" name="date_debut" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="date_fin">Date de fin</label>
            <input type="date" name="date_fin" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
