
<div class="container">
    <h1>Ma Bibliothèque</h1>

    <h2>Ajouter un contenu</h2>
    <form action="{{ route('bibliotheques.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="content_id">Contenu</label>
            <select name="content_id" id="content_id" class="form-control" required>
                @foreach($contents as $content)
                    <option value="{{ $content->id }}">{{ $content->titre }} ({{ $content->type }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="statut">Statut</label>
            <select name="statut" id="statut" class="form-control" required>
                <option value="en cours">En cours</option>
                <option value="a voir">À voir</option>
                <option value="termine">Terminé</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter à ma bibliothèque</button>
    </form>

    <h2>Mes contenus</h2>
    <ul>
        @foreach($bibliotheques as $bibliotheque)
            <li>
                <strong>{{ $bibliotheque->content->titre }}</strong> ({{ $bibliotheque->statut }})
                <form action="{{ route('bibliotheques.update', $bibliotheque->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <select name="statut" onchange="this.form.submit()">
                        <option value="en cours" {{ $bibliotheque->statut == 'en cours' ? 'selected' : '' }}>En cours</option>
                        <option value="a voir" {{ $bibliotheque->statut == 'a voir' ? 'selected' : '' }}>À voir</option>
                        <option value="termine" {{ $bibliotheque->statut == 'termine' ? 'selected' : '' }}>Terminé</option>
                    </select>
                </form>
                <form action="{{ route('bibliotheques.destroy', $bibliotheque->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
