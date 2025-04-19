<div>le titre est {{$content->titre}}</div>
<div>le description est {{$content->description}}</div>
<div>la date est {{$content->datePublication}}</div>
<div>le type est {{$content->type}}</div>
<div>le genre est {{$content->category->nom}}</div>
<a href="{{ route('content.index') }}" class="bg-blue-600 text-white rounded-md w-[80px] h-[30px] inline-block text-center">
    Revenir
</a>
        @if($content->type === 'anime' && $content->anime)
            <a href="{{ route('anime.details', ['id' => $content->anime->id]) }}" class="text-blue-600 underline">Tout les details</a>
        @elseif($content->type === 'manga' && $content->manga)
            <a href="{{ route('manga.details', ['id' => $content->manga->id]) }}" class="text-blue-600 underline">Tout les details</a>
        @endif