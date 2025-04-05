
    <h1>Pages du Chapitre {{ $chapitre->id }}</h1>

    @if($pages->isEmpty())
        <p>Aucune page trouvée pour ce chapitre.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Numéro de Page</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td>{{ $page->numero_page }}</td>
                        <td><img src="{{ asset($page->contenu) }}" alt="Page {{ $page->numero_page }}" width="200"></td>
                        <td><button  onclick="openUpdateModal({{ $page->id }}, {{ $page->numero_page }}, '{{ asset($page->contenu) }}')">
   Modifier
</button></td>
<td>
<form action="{{ route('manga.pages.destroy', $page->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette page ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('manga.chapitres.index', ['manga_id' => $chapitre->manga_id]) }}" class="btn btn-secondary">Retour aux chapitres</a>

<a href="{{ route('manga.chapitres.pages.show', $page->chapitre_id) }}">Retour</a>



<!-- Modal -->
<div id="updateModal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
     background:white; padding:20px; border:1px solid #ccc; z-index:1000;">
    <h2>Modifier la Page</h2>
    <form action="{{ route('manga.pages.update', $page->id) }}" id="updateForm" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Numéro de la page :</label>
        <input type="number" name="numero_page" id="numero_page" required min="1">

        <br><label>Image actuelle :</label><br>
        <img id="current_image" src="" width="200"><br><br>

        <label>Nouvelle image (optionnel) :</label>
        <input type="file" name="contenu"><br><br>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <button type="button" onclick="closeModal()" class="btn btn-secondary">Annuler</button>
    </form>
</div>

<div id="modalOverlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
     background:rgba(0,0,0,0.5); z-index:999;" onclick="closeModal()"></div>


<script>
function openUpdateModal(id, numeroPage, imageUrl) {
    document.getElementById('numero_page').value = numeroPage;
    document.getElementById('current_image').src = imageUrl;
    document.getElementById('updateForm').action = `/pages/${id}`;
    document.getElementById('updateModal').style.display = 'block';
    document.getElementById('modalOverlay').style.display = 'block';
}
function closeModal() {
    document.getElementById('updateModal').style.display = 'none';
    document.getElementById('modalOverlay').style.display = 'none';
}
</script>
