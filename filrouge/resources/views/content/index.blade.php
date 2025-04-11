<script src="https://cdn.tailwindcss.com"></script>

<form action="" method="POST">
    @csrf
    <input type="text" name="titre" placeholder="titre">
    <input type="text" name="description" placeholder="description">
    <input type="date" name="datePublication" placeholder="datePublication">
    <input type="text" name="genre" placeholder="genre">
    <select name="type" id="type">
    <option value="anime">Anime</option>
    <option value="manga">manga</option>
</select>
<button type="submit" class="bg-black text-white rounded-md w-[60px] h-[30px]">Ajouter</button>


</form>
<div>
    @if(isset($contents) && count($contents)>0)
    @foreach ($contents as $content)
    <div>le titre est {{$content->titre}}</div>
    <div>le description est {{$content->description}}</div>
    <div>la date est {{$content->datePublication}}</div>
    <div>le type est {{$content->type}}</div>
    <div>le genre est {{$content->genre}}</div>

    @if(in_array($content->id, $bibliothequeIds))
    <form action="{{ route('bibliotheque.retirer', ['content_id' => $content->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 text-white rounded-md w-[260px] h-[30px]">
            Retirer de la bibliothèque
        </button>
    </form>
@else
    <form action="{{ route('bibliotheque.ajouter', ['content_id' => $content->id]) }}" method="POST">
        @csrf
        <select name="statut" required class="border border-gray-300 rounded-md mb-2">
            <option value="en cours">En cours</option>
            <option value="a voir">À voir</option>
            <option value="termine">Terminé</option>
        </select>
        <button type="submit" class="bg-black text-white rounded-md w-[260px] h-[30px]">
            Ajouter à la bibliothèque
        </button>
    </form>
@endif


    <button class="bg-gray-400 text-white rounded-md w-[60px] h-[30px]" onClick="modifierContent({{$content->id}},'{{$content->titre}}', '{{$content->description}}','{{$content->datePublication}}','{{$content->type}}','{{$content->genre}}')">
        modifier</button>
        <a href="{{ route('content.details', ['id' => $content->id]) }}" class="bg-black text-white rounded-md w-[80px] h-[30px] inline-block text-center">
    Lire
</a>
@if($content->type == "anime" && !isset($content->anime))
<a href="{{ route('anime.create', ['content_id' => $content->id]) }}" class="bg-black text-white rounded-md w-[260px] h-[30px] inline-block text-center">
ajouter ton anime content
</a>
@elseif($content->type == "manga" && !isset($content->manga))
<a href="{{ route('manga.create', ['content_id' => $content->id]) }}" class="bg-black text-white rounded-md w-[260px] h-[30px] inline-block text-center">
ajouter ton manga content
</a>
@endif
<button class="bg-gray-600 text-white rounded-md w-[60px] h-[30px]" onClick="supprimerContent({{$content->id}})">
        supprimer</button>
    @endforeach
    @else
    <div>y a rien usque la </div>
    @endif
</div>


<form action="{{ route('content.update') }}" method="POST" class="hidden" id="modifierform">
    @csrf
    <input name="MID" id="MID" type="hidden">
    <input type="text" id="Mtitre" name="Mtitre" placeholder="titre">
    <input type="text" id="Mdescription" name="Mdescription" placeholder="description">
    <input type="date" id="MdatePublication" name="MdatePublication" placeholder="datePublication">
    <input type="text" id="Mgenre" name="Mgenre" placeholder="genre">
    <select name="Mtype" id="Mtype">
    <option value="anime">Anime</option>
    <option value="manga">manga</option>
</select>
<button type="submit">Modifier</button>
</form>

<form action="{{ route('content.delete') }}" method="POST" class="hidden" id="deleteform">
@csrf
<input type="hidden" id="DID" name="DID">
<div>tu es sure que vous voulez supprimer ce contenu ? </div>
<button type="submit">Oui</button>
<button >Non</button>
</form>
<script>
    function modifierContent(k,a,b,c,d,e){
        document.getElementById("modifierform").classList.remove("hidden");
        document.getElementById("MID").value=k;
        document.getElementById("Mtitre").value=a;
        document.getElementById("Mdescription").value=b;
        document.getElementById("MdatePublication").value=c;
        document.getElementById("Mgenre").value=e;
        document.getElementById("Mtype").value=d;
    }
    function supprimerContent(id){
        document.getElementById("deleteform").classList.remove("hidden");
        document.getElementById("DID").value=id;

    }


</script>