<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Chapitres Manga</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#8B5CF6',
                        secondary: '#C084FC'
                    },
                    borderRadius: {
                        'none': '0px',
                        'sm': '4px',
                        DEFAULT: '8px',
                        'md': '12px',
                        'lg': '16px',
                        'xl': '20px',
                        '2xl': '24px',
                        '3xl': '32px',
                        'full': '9999px',
                        'button': '8px'
                    }
                }
            }
        }
    </script>
    <style>
        :where([class^="ri-"])::before {
            content: "\f3c2";
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        .manga-header {
            background-image: url('https://readdy.ai/api/search-image?query=Anime%20manga%20background%20with%20subtle%20pattern%2C%20light%20colors%2C%20minimalist%20Japanese%20art%20style%2C%20soft%20gradients%2C%20perfect%20for%20a%20manga%20website%20header%2C%20professional%20design%2C%20clean%20and%20modern&width=1200&height=300&seq=12345&orientation=landscape');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body>
    @include('partials.header')

    <div class="min-h-screen">
        <header class="manga-header bg-gradient-to-r from-purple-50 to-pink-50 py-8 pt-20">
            <div class="container mx-auto px-4 md:px-6">
                <h1 class="text-3xl font-bold text-gray-800 text-center">Gestion des Chapitres</h1>
                <p class="text-gray-600 text-center mt-2">Ajoutez, modifiez et gérez les chapitres de votre manga</p>
            </div>
        </header>
        <main class="container mx-auto px-4 md:px-6 py-8">
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">
                    {{ isset($editChapitre) ? 'Modifier le Chapitre' : 'Ajouter un Nouveau Chapitre' }}
                </h2>
                <form
                    action="{{ isset($editChapitre) ? route('manga.chapitres.update', $editChapitre->id) : route('manga.chapitres.store') }}"
                    method="POST" class="space-y-4">
                    @csrf
                    @if(isset($editChapitre))
                        @method('PUT')
                    @endif
                    <input type="hidden" name="manga_id" value="{{ $manga_id }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nbr_pages" class="block text-sm font-medium text-gray-700 mb-1">Nombre de
                                Pages</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="ri-file-list-line text-gray-400"></i>
                                </div>
                                <input type="number" id="nbr_pages" name="nbr_pages"
                                    value="{{ $editChapitre->nbr_pages ?? '' }}" required
                                    class="pl-10 w-full h-10 border border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary text-sm"
                                    placeholder="Entrez le nombre de pages">
                            </div>
                        </div>
                        <div>
                            <label for="date_ajout" class="block text-sm font-medium text-gray-700 mb-1">Date
                                d'Ajout</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="ri-calendar-line text-gray-400"></i>
                                </div>
                                <input type="date" id="date_ajout" name="date_ajout"
                                    value="{{ $editChapitre->date_ajout ?? '' }}" required
                                    class="pl-10 w-full h-10 border border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary text-sm">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="bg-primary text-white px-4 py-2 !rounded-button hover:bg-opacity-90 transition-all whitespace-nowrap flex items-center">
                            <i class="ri-save-line mr-2"></i>
                            {{ isset($editChapitre) ? 'Mettre à jour' : 'Ajouter' }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-gray-100 px-4 text-sm text-gray-500">Liste des chapitres</span>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if($chapitres->isEmpty())
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-gray-100 rounded-full">
                            <i class="ri-file-list-3-line text-gray-400 ri-2x"></i>
                        </div>
                        <p class="text-gray-600">Aucun chapitre trouvé.</p>
                        <p class="text-gray-500 text-sm mt-2">Ajoutez votre premier chapitre en utilisant le formulaire
                            ci-dessus.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Pages</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($chapitres as $chapitre)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $chapitre->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="flex items-center">
                                                <i class="ri-file-list-line mr-2 text-gray-400"></i>
                                                {{ $chapitre->nbr_pages }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="flex items-center">
                                                <i class="ri-calendar-line mr-2 text-gray-400"></i>
                                                {{ $chapitre->date_ajout }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <div class="flex flex-wrap gap-2">
                                                <a href="{{ route('manga.chapitres.show', $chapitre->id) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-purple-50 text-purple-600 !rounded-button hover:bg-purple-100 whitespace-nowrap">
                                                    <i class="ri-eye-line mr-1"></i> Voir
                                                </a>
                                                @if(Auth::user()->role == 'admin')

                                                <a href="{{ route('manga.chapitres.edit', $chapitre->id) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-fuchsia-50 text-fuchsia-600 !rounded-button hover:bg-fuchsia-100 whitespace-nowrap">
                                                    <i class="ri-edit-line mr-1"></i> Modifier
                                                </a>
                                                <form action="{{ route('manga.chapitres.destroy', $chapitre->id) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 !rounded-button hover:bg-red-100 whitespace-nowrap"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce chapitre?')">
                                                        <i class="ri-delete-bin-line mr-1"></i> Supprimer
                                                    </button>
                                                </form>
                                                <a href="{{ route('manga.pages.create', ['chapitre_id' => $chapitre->id]) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-violet-50 text-violet-600 !rounded-button hover:bg-violet-100 whitespace-nowrap">
                                                    <i class="ri-add-line mr-1"></i> Ajouter pages
                                                </a>
                                                <a href="{{ route('manga.chapitres.pages.show', ['chapitre_id' => $chapitre->id]) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-purple-50 text-purple-600 !rounded-button hover:bg-purple-100 whitespace-nowrap">
                                                    <i class="ri-pages-line mr-1"></i> Voir pages
                                                </a>
                                                @endif
                                                <button
                                                    onclick="ouvrirCommentaireModal({{ $chapitre->manga->content_id }}, {{ $chapitre->id}}, null)"
                                                    class="inline-flex items-center px-3 py-1.5 bg-purple-50 text-purple-600 !rounded-button hover:bg-purple-100 whitespace-nowrap">
                                                    <i class="ri-chat-1-line mr-1"></i> Commenter
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            <!-- Back Button -->
            <div class="mt-8">
                <a href="{{ route('content.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 !rounded-button hover:bg-gray-200 transition-all whitespace-nowrap">
                    <i class="ri-arrow-left-line mr-2"></i>
                    Retour à la liste
                </a>
            </div>
        </main>
    </div>
    <div id="commentModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Ajouter un commentaire</h3>
            </div>
            <form method="POST" action="{{ route('commentaire.store') }}" class="p-6">
                @csrf
                <input type="hidden" name="content_id" id="commentContentId">
                <input type="hidden" name="chapitre_id" id="commentChapitreId">
                <input type="hidden" name="episode_id" id="commentEpisodeId">
                <div class="mb-4">
                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">Votre commentaire</label>
                    <textarea name="comment" id="comment" rows="4" required
                        class="w-full border border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary p-2 text-sm"
                        placeholder="Partagez votre avis sur ce chapitre..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="fermerCommentaireModal()"
                        class="px-4 py-2 border border-gray-300 text-gray-700 !rounded-button hover:bg-gray-50 whitespace-nowrap">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-primary text-white !rounded-button hover:bg-opacity-90 whitespace-nowrap">
                        Publier
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dateInput = document.getElementById('date_ajout');
            if (dateInput && !dateInput.value) {
                const today = new Date();
                const year = today.getFullYear();
                let month = today.getMonth() + 1;
                let day = today.getDate();
                month = month < 10 ? '0' + month : month;
                day = day < 10 ? '0' + day : day;
                dateInput.value = `${year}-${month}-${day}`;
            }
        });
        function ouvrirCommentaireModal(contentId, chapitreId, episodeId) {
            document.getElementById('commentContentId').value = contentId;
            document.getElementById('commentChapitreId').value = chapitreId;
            document.getElementById('commentEpisodeId').value = episodeId;
            document.getElementById('commentModal').classList.remove('hidden');
        }
        function fermerCommentaireModal() {
            document.getElementById('commentModal').classList.add('hidden');
            document.getElementById('comment').value = '';
        }
    </script>
</body>

</html>