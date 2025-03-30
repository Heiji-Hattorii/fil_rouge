<div>le titre est {{$content->titre}}</div>
<div>le description est {{$content->description}}</div>
<div>la date est {{$content->datePublication}}</div>
<div>le type est {{$content->type}}</div>
<div>le genre est {{$content->genre}}</div>
<a href="{{ route('content.index') }}" class="bg-blue-600 text-white rounded-md w-[80px] h-[30px] inline-block text-center">
    Revenir
</a>