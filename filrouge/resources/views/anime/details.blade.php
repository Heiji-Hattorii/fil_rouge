<div>Le titre est : {{ $anime->content->titre }}</div>
<div>La description est : {{ $anime->content->description }}</div>
<div>La date est : {{ $anime->content->datePublication }}</div>
<div>Le type est : {{ $anime->content->type }}</div>
<div>Le genre est : {{ $anime->content->genre }}</div>

<div>Nombre d'épisodes : {{ $anime->nbr_episodes }}</div>
<div>Nombre de saisons : {{ $anime->nbr_saisons }}</div>
<div>Date de début : {{ $anime->date_debut }}</div>
<div>Date de fin : {{ $anime->date_fin }}</div>
<div>Producteur : {{ $anime->producteur }}</div>

<a href="{{ route('content.index') }}" class="bg-blue-600 text-white rounded-md w-[80px] h-[30px] inline-block text-center">
    Revenir
</a>
