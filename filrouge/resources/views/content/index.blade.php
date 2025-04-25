<script src="https://cdn.tailwindcss.com"></script>
<form method="GET" action="{{ route('content.filter') }}">
    <input type="text" name="titre" placeholder="Titre" value="{{ request('titre') }}">

    <select name="category_id">
        <option value="">-- Catégorie --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->nom }}
            </option>
        @endforeach
    </select>

    <input type="number" name="annee" placeholder="Année" value="{{ request('annee') }}">

    <button type="submit">Filtrer</button>
</form>

<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="photo" required>
    <input type="text" name="titre" placeholder="titre" required>
    <input type="text" name="description" placeholder="description" required>
    <input type="date" name="datePublication" placeholder="datePublication" required>
    <select name="category_id" required>
    @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->nom }}</option>
    @endforeach
</select>
    <select name="type" id="type">
        <option value="anime">A</option>
        <option value="manga">manga</option>
    </select>
    <button type="submit">Ajouter</button>
</form>
<p>
    @if(isset($contents) && count($contents) > 0)
            @foreach ($contents as $content)
                <p>le titre est {{$content->titre}}</p>
                <p>le description est {{$content->description}}</p>
                <p>la date est {{$content->datePublication}}</p>
                <p>le type est {{$content->type}}</p>
                <p>la catégorie est {{$content->category->nom}}</p>

                @if(in_array($content->id, $bibliothequeIds))
                    <form action="{{ route('bibliotheque.retirer', ['content_id' => $content->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            Retirer de la bibliothèque
                        </button>
                    </form>
                @else
                    <form action="{{ route('bibliotheque.ajouter', ['content_id' => $content->id]) }}" method="POST">
                        @csrf
                        <select name="statut" required>
                            <option value="en cours">En cours</option>
                            <option value="a voir">À voir</option>
                            <option value="termine">Terminé</option>
                        </select>
                        <button type="submit">
                            Ajouter à la bibliothèque
                        </button>
                    </form>
                @endif


                <button
                onClick="modifierContent({{$content->id}},'{{$content->titre}}', '{{$content->description}}','{{$content->datePublication}}','{{$content->type}}', {{$content->category_id}})"
                >
                    modifier</button>

                <a href="{{ route('content.quiz.index', ['content' => $content->id]) }}">
                    Quiz
                </a>
                <a href="{{ route('content.details', ['id' => $content->id]) }}">
                    Lire
                </a>
                @if($content->type == "anime" && !isset($content->anime))
                    <a href="{{ route('anime.create', ['content_id' => $content->id]) }}">
                        ajouter ton anime content
                    </a>
                @elseif($content->type == "manga" && !isset($content->manga))
                    <a href="{{ route('manga.create', ['content_id' => $content->id]) }}">
                        ajouter ton manga content
                    </a>
                @endif
                <button onClick="supprimerContent({{$content->id}})">
                    supprimer</button>
            @endforeach
    @else
        <p>y a rien usque la </p>
    @endif
</p>


<form action="{{ route('content.update') }}" method="POST" class="hidden" id="modifierform">
    @csrf
    <input name="MID" id="MID" type="hidden">
    <input type="text" id="Mtitre" name="Mtitre" placeholder="titre">
    <input type="text" id="Mdescription" name="Mdescription" placeholder="description">
    <input type="date" id="MdatePublication" name="MdatePublication" placeholder="datePublication">
    <select name="Mcategory_id" id="Mcategory_id" required>
    @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->nom }}</option>
    @endforeach
</select>
    <select name="Mtype" id="Mtype">
        <option value="anime">Anime</option>
        <option value="manga">manga</option>
    </select>
    <button type="submit">Modifier</button>
</form>

<form action="{{ route('content.delete') }}" method="POST" class="hidden" id="deleteform">
    @csrf
    <input type="hidden" id="DID" name="DID">
    <p>tu es sure que vous voulez supprimer ce contenu ? </p>
    <button type="submit">Oui</button>
    <button>Non</button>
</form>
<script>
function modifierContent(k, a, b, c, d, categoryId) {
    document.getElementById("modifierform").classList.remove("hidden");
    document.getElementById("MID").value = k;
    document.getElementById("Mtitre").value = a;
    document.getElementById("Mdescription").value = b;
    document.getElementById("MdatePublication").value = c;
    document.getElementById("Mtype").value = d;
    document.getElementById("Mcategory_id").value = categoryId;
}

    function supprimerContent(id) {
        document.getElementById("deleteform").classList.remove("hidden");
        document.getElementById("DID").value = id;

    }


</script>