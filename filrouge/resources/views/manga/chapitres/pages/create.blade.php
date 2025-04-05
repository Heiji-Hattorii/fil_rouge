<form action="{{ route('manga.pages.store', ['chapitre_id' => $chapitre->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div id="pages-container">
        <div class="page-group">
            <label>Image de la page :</label>
            <input type="file" name="pages[]" required>

            <label>Numéro de la page :</label>
            <input type="number" name="numero_page" required min="1">
        </div>
    </div>

    <button type="button" onclick="ajouterPage()">Ajouter une autre page</button>
    <button type="submit">Envoyer</button>
</form>

<script>
function ajouterPage() {
    const container = document.getElementById('pages-container');
    const group = document.createElement('div');
    group.classList.add('page-group');
    group.innerHTML = `
        <label>Image de la page :</label>
        <input type="file" name="pages[]" required>

        <label>Numéro de la page :</label>
        <input type="number" name="numero_page[]" required min="1">
    `;
    container.appendChild(group);
}
</script>
