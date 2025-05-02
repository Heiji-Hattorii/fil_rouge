<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Épisodes Anime</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>

        #episodeModal.flex {
            display: flex;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }
        .anime-bg {
            background-image: url('{{ asset('img/jj.jpg') }}');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
@include('partials.header')

<body>
    <div class="anime-bg pt-40 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-center text-white drop-shadow-lg mb-4">Épisodes de
                {{ $anime->content->titre }}
            </h1>
            <p class="text-center text-white/90 max-w-2xl mx-auto mb-8">Gérez tous les épisodes de votre anime préféré.
                Ajoutez, modifiez ou supprimez des épisodes facilement.</p>
        </div>
    </div>
    <div class="container mx-auto px-4 py-12">
        <div class="bg-white rounded-xl shadow-lg p-6 mb-12">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800 flex items-center">
                <div class="w-8 h-8 flex items-center justify-center mr-2 bg-[#6366f1]/10 rounded-full">
                    <i class="ri-add-line text-[#6366f1]"></i>
                </div>
                Ajouter un nouvel épisode
            </h2>
            <form action="{{ route('anime.episodes.store', ['anime_id' => $anime->id]) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label for="numero_episode" class="block text-sm font-medium text-gray-700">Numéro de
                            l'épisode</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="ri-number-1 text-gray-400"></i>
                            </div>
                            <input type="number" name="numero_episode" id="numero_episode"
                                class="pl-10 w-full border-gray-300 focus:border-[#6366f1] focus:ring focus:ring-[#6366f1]/20 rounded py-2.5 border"
                                required>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="date_ajout" class="block text-sm font-medium text-gray-700">Date d'ajout</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="ri-calendar-line text-gray-400"></i>
                            </div>
                            <input type="date" name="date_ajout" id="date_ajout"
                                class="pl-10 w-full border-gray-300 focus:border-[#6366f1] focus:ring focus:ring-[#6366f1]/20 rounded py-2.5 border"
                                required>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="contenu" class="block text-sm font-medium text-gray-700">Vidéo</label>
                        <div class="relative">
                            <div class="flex items-center justify-center w-full">
                                <label for="contenu"
                                    class="flex flex-col items-center justify-center w-full h-11 border-2 border-gray-300 border-dashed rounded cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex items-center">
                                        <i class="ri-upload-2-line mr-2 text-gray-500"></i>
                                        <span class="text-sm text-gray-500">Choisir un fichier</span>
                                    </div>
                                    <input id="contenu" type="file" name="contenu" accept="video/*" class="hidden"
                                        required>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-[#6366f1] hover:bg-[#6366f1]/90 text-white px-6 py-2.5 !rounded-button font-medium flex items-center whitespace-nowrap">
                        <i class="ri-add-line mr-2"></i>
                        Ajouter l'épisode
                    </button>
                </div>
            </form>
            @if ($errors->any())
                <div class="mt-4 p-4 bg-red-50 rounded-lg border border-red-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="ri-error-warning-line text-red-500 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Veuillez corriger les erreurs suivantes :</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800 flex items-center">
                <div class="w-8 h-8 flex items-center justify-center mr-2 bg-[#6366f1]/10 rounded-full">
                    <i class="ri-movie-line text-[#6366f1]"></i>
                </div>
                Liste des épisodes
            </h2>
            @if($episodes->isEmpty())
                <div class="text-center py-12">
                    <div class="w-20 h-20 mx-auto flex items-center justify-center bg-gray-100 rounded-full mb-4">
                        <i class="ri-film-line text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">Aucun épisode trouvé</h3>
                    <p class="text-gray-500 max-w-md mx-auto">Commencez par ajouter votre premier épisode en utilisant le
                        formulaire ci-dessus.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Numéro</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contenu</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date d'ajout</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($episodes as $episode)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 flex items-center justify-center bg-[#6366f1]/10 rounded-full mr-3 text-[#6366f1] font-medium">
                                                {{ $episode->numero_episode }}
                                            </div>
                                            <span class="text-sm text-gray-900">Épisode {{ $episode->numero_episode }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="relative rounded-lg overflow-hidden shadow-sm">
                                            <video width="200" height="120" controls class="object-cover rounded">
                                                <source src="{{ asset($episode->contenu) }}" type="video/mp4">
                                                Votre navigateur ne supporte pas la lecture vidéo
                                            </video>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <i class="ri-calendar-line text-gray-400 mr-2"></i>
                                            <span class="text-sm text-gray-500">{{ $episode->date_ajout }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex space-x-2">
                                            <button
                                                onclick="openEpisodeModal({{ $episode->id }}, {{ $episode->numero_episode }}, '{{ asset($episode->contenu) }}', '{{ $episode->date_ajout }}', {{ $anime->id }})"
                                                class="bg-violet-300 hover:bg-blue-600 text-white px-3 py-1.5 !rounded-button whitespace-nowrap flex items-center">
                                                <i class="ri-edit-line mr-1"></i>
                                                Modifier
                                            </button>
                                            <a href="{{route('anime.episodes.show', ['anime_id' => $anime->id, 'id' => $episode->id]) }}"
                                                class="bg-violet-500 hover:bg-green-600 text-white px-3 py-1.5 !rounded-button whitespace-nowrap flex items-center">
                                                <i class="ri-eye-line mr-1"></i>
                                                Voir
                                            </a>
                                            <form
                                                action="{{ route('anime.episodes.destroy', ['anime_id' => $anime->id, 'id' => $episode->id]) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-violet-900 hover:bg-red-600 text-white px-3 py-1.5 !rounded-button whitespace-nowrap flex items-center">
                                                    <i class="ri-delete-bin-line mr-1"></i>
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <div id="episodeModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl mx-4 overflow-hidden">
            <div class="w-full p-6">
                <div class="flex justify-end">
                    <button onclick="closeEpisodeModal()" class="text-gray-400 hover:text-gray-600 transition">
                        <i class="ri-close-line text-2xl"></i>
                    </button>
                </div>
                <form id="episodeForm" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="modal_numero_episode" class="block text-sm font-medium text-gray-700">
                                Numéro de l'épisode
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="ri-number-1 text-gray-400"></i>
                                </div>
                                <input type="number" name="numero_episode" id="modal_numero_episode"
                                    class="pl-10 w-full border-gray-300 focus:border-[#6366f1] focus:ring focus:ring-[#6366f1]/20 rounded py-2.5 border"
                                    required>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="modal_date_ajout" class="block text-sm font-medium text-gray-700">
                                Date d'ajout
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="ri-calendar-line text-gray-400"></i>
                                </div>
                                <input type="date" name="date_ajout" id="modal_date_ajout"
                                    class="pl-10 w-full border-gray-300 focus:border-[#6366f1] focus:ring focus:ring-[#6366f1]/20 rounded py-2.5 border"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Aperçu vidéo actuel</label>
                        <div class="relative rounded-lg overflow-hidden border border-gray-200">
                            <video width="100%" controls id="current_video" class="max-h-[200px] w-full object-cover">
                                <source src="" type="video/mp4">
                                Votre navigateur ne supporte pas la lecture vidéo
                            </video>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="modal_contenu" class="block text-sm font-medium text-gray-700">Nouvelle
                            vidéo</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="modal_contenu"
                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-300">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="ri-upload-cloud-line text-4xl text-gray-400 mb-2"></i>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Cliquez pour
                                            télécharger</span> ou glissez et déposez</p>
                                    <p class="text-xs text-gray-500">MP4, WebM (MAX. 500MB)</p>
                                </div>
                                <input id="modal_contenu" type="file" name="contenu" accept="video/*" class="hidden">
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeEpisodeModal()"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-6 py-2.5 !rounded-button font-medium whitespace-nowrap flex items-center">
                            <i class="ri-close-line mr-2"></i>
                            Annuler
                        </button>
                        <button type="submit"
                            class="bg-[#6366f1] hover:bg-[#6366f1]/90 text-white px-6 py-2.5 !rounded-button font-medium whitespace-nowrap flex items-center">
                            <i class="ri-save-line mr-2"></i>
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    <script>
        function openEpisodeModal(episodeId, numeroEpisode, contenuUrl, dateAjout, animeId) {
            const modal = document.getElementById('episodeModal');
            const form = document.getElementById('episodeForm');
            const videoPlayer = document.getElementById('current_video');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            form.action = `/anime/${animeId}/episodes/${episodeId}`;
            document.getElementById('modal_numero_episode').value = numeroEpisode;
            document.getElementById('modal_date_ajout').value = dateAjout;
            const videoSource = videoPlayer.querySelector('source');
            videoSource.src = contenuUrl;
            videoPlayer.load();
        }
        function closeEpisodeModal() {
            const modal = document.getElementById('episodeModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeEpisodeModal();
            }
        });
        document.getElementById('episodeModal').addEventListener('click', function (event) {
            if (event.target === this) {
                closeEpisodeModal();
            }
        });
    </script>
</body>

</html>