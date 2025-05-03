<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime & Manga - Bibliothèque de Contenu</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>


        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9ff;
            color: #1F2937;
        }

        .card-anime {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-anime:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(124, 58, 237, 0.1), 0 10px 10px -5px rgba(124, 58, 237, 0.04);
        }


        .anime-badge {
            background-color: #DC2626;
        }

        .manga-badge {
            background-color: #7C3AED;
        }



        .custom-file-input::before {
            content: 'Sélectionner';
        }
    </style>
</head>

<body>
@include('partials.header')

    <header class="bg-gradient-to-r from-[#7C3AED] to-[#DC2626] py-6 pt-20">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-white text-center font-['Pacifico']">蓮の花</h1>
            <p class="text-white text-center mt-2 opacity-90">Votre bibliothèque d'anime et manga préférés</p>
        </div>
    </header>
    <main class="container mx-auto px-4 py-8">

    <section class="bg-white rounded-lg shadow-md p-6 mb-8">
            <form method="GET" action="{{ route('content.filter') }}" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1">
                    <label for="titre" class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                <i class="ri-search-line"></i>
                            </div>
                        </div>
                        <input type="text" name="titre" id="titre" placeholder="Rechercher par titre"
                            value="{{ request('titre') }}"
                            class="pl-10 w-full border-gray-300 border rounded-md rounded-button py-2 px-4 focus:ring-2 focus:ring-[#7C3AED] focus:border-[#7C3AED] text-sm">
                    </div>
                </div>
                <div class="flex-1">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                <i class="ri-folder-line"></i>
                            </div>
                        </div>
                        <select name="category_id" id="category_id"
                            class="pl-10 w-full border-gray-300 border rounded-md rounded-button py-2 px-4 pr-8 focus:ring-2 focus:ring-[#7C3AED] focus:border-[#7C3AED] text-sm appearance-none bg-white">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nom }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                <i class="ri-arrow-down-s-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <label for="annee" class="block text-sm font-medium text-gray-700 mb-1">Année</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                <i class="ri-calendar-line"></i>
                            </div>
                        </div>
                        <input type="number" name="annee" id="annee" placeholder="Ex: 2023"
                            value="{{ request('annee') }}"
                            class="pl-10 w-full border-gray-300 border rounded-md rounded-button py-2 px-4 focus:ring-2 focus:ring-[#7C3AED] focus:border-[#7C3AED] text-sm">
                    </div>
                </div>
                <div>
                    <button type="submit"
                        class="bg-[#7C3AED] hover:bg-[#7C3AED]/90 text-white py-2 px-6 rounded-md rounded-button whitespace-nowrap transition-all flex items-center gap-2">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <i class="ri-filter-3-line"></i>
                        </div>
                        <span>Filtrer</span>
                    </button>
                </div>
            </form>
            </div>
            </div>
            <section class="flex justify-end mb-8">
                <button type="button" onclick="openAddModal()"
                    class="bg-[#7C3AED] hover:bg-[#7C3AED]/90 text-white my-6 py-2 px-6 rounded-md  rounded-button whitespace-nowrap transition-all flex items-center gap-2">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-add-line"></i>
                    </div>
                    <span>Créer un contenu</span>
                </button>
            </section>
            <div id="addModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-4xl mx-4 max-h-[90vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-gray-900">Ajouter un nouveau contenu</h3>
                        <button type="button" onclick="closeAddModal()" class=" rounded-md text-gray-400 hover:text-gray-500">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-close-line"></i>
                            </div>
                        </button>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data"
                        class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        <div class="md:col-span-2">
                            <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-[#7C3AED] transition-colors">
                                <div class="w-12 h-12 mx-auto mb-2 flex items-center justify-center text-gray-400">
                                    <i class="ri-image-add-line ri-2x"></i>
                                </div>
                                <p class="text-sm text-gray-500 mb-2">Glissez votre image ici ou</p>
                                <div class="relative">
                                    <input type="file" name="photo" id="photo" required
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                    <button type="button"
                                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 px-4 rounded-button rounded-md whitespace-nowrap !rounded-button">Parcourir
                                        les fichiers</button>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF jusqu'à 5MB</p>
                            </div>
                        </div>
                        <div>
                            <label for="titre" class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
                            <input type="text" name="titre" id="titre" placeholder="Titre du contenu" required
                                class="w-full border-gray-300 border rounded-md rounded-button py-2 px-4 focus:ring-2 focus:ring-[#7C3AED] focus:border-[#7C3AED] text-sm">
                        </div>
                        <div>
                            <label for="datePublication" class="block text-sm font-medium text-gray-700 mb-1">Date de
                                publication</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                        <i class="ri-calendar-line"></i>
                                    </div>
                                </div>
                                <input type="date" name="datePublication" id="datePublication" required
                                    class="pl-10 w-full border-gray-300 border rounded-md rounded-button py-2 px-4 focus:ring-2 focus:ring-[#7C3AED] focus:border-[#7C3AED] text-sm">
                            </div>
                        </div>
                        <div>
                            <label for="category_id"
                                class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                        <i class="ri-folder-line"></i>
                                    </div>
                                </div>
                                <select name="category_id" id="category_id" required
                                    class="pl-10 w-full border-gray-300 border rounded-md rounded-button py-2 px-4 pr-8 focus:ring-2 focus:ring-[#7C3AED] focus:border-[#7C3AED] text-sm appearance-none bg-white">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nom }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                        <i class="ri-film-line"></i>
                                    </div>
                                </div>
                                <select name="type" id="type"
                                    class="pl-10 w-full border-gray-300 border rounded-md rounded-button py-2 px-4 pr-8 focus:ring-2 focus:ring-[#7C3AED] focus:border-[#7C3AED] text-sm appearance-none bg-white">
                                    <option value="anime">Anime</option>
                                    <option value="manga">Manga</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" id="description" rows="4" placeholder="Description du contenu"
                                required
                                class="w-full border-gray-300 border rounded-md rounded-button py-2 px-4 focus:ring-2 focus:ring-[#7C3AED] focus:border-[#7C3AED] text-sm"></textarea>
                        </div>
                        <div class="md:col-span-2 flex justify-end">
                            <button type="submit"
                                class="bg-[#7C3AED] hover:bg-[#7C3AED]/90 text-white py-2 px-6 rounded-md rounded-button whitespace-nowrap transition-all flex items-center gap-2">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-add-line"></i>
                                </div>
                                <span>Ajouter</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <section>
                <h2 class="text-2xl font-semibold mb-6">Bibliothèque de contenu</h2>
                @if(isset($contents) && count($contents) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($contents as $content)
                            <div class="bg-white rounded-lg overflow-hidden shadow-md card-anime">
                                <div class="h-48 bg-gray-200 relative">
                                    <img src="{{ asset($content->photo) }}"
                                        alt="{{ $content->titre }}" class="w-full h-full object-cover object-top">
                                    <div class="absolute top-3 right-3">
                                        <span
                                            class="{{ $content->type == 'anime' ? 'anime-badge' : 'manga-badge' }} text-white text-xs px-2 py-1 rounded-full">
                                            {{ $content->type == 'anime' ? 'Anime' : 'Manga' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-2 line-clamp-1">{{ $content->titre }}</h3>
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $content->description }}</p>
                                    <div class="flex items-center text-xs text-gray-500 gap-4 mb-3">
                                        <div class="flex items-center gap-1">
                                            <div class="w-4 h-4 flex items-center justify-center">
                                                <i class="ri-calendar-line"></i>
                                            </div>
                                            <span>{{ $content->datePublication }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <div class="w-4 h-4 flex items-center justify-center">
                                                <i class="ri-folder-line"></i>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-2">
    {{ $content->category ? $content->category->nom : 'Catégorie inconnue' }}
</p>
                                        </div>
                                    </div>
                                    <div class="border-t border-gray-100 pt-3 space-y-3">
                                        <div class="flex items-center justify-between gap-2">
                                            @if(Auth::user()->role == 'admin')
                                            <button
                                                onClick="modifierContent({{$content->id}},'{{$content->titre}}', '{{$content->description}}','{{$content->datePublication}}','{{$content->type}}', {{$content->category_id}})"
                                                class="flex items-center gap-1 text-gray-600 hover:text-[#7C3AED] text-sm transition-colors !rounded-button">
                                                <div class="w-4 h-4 flex items-center justify-center">
                                                    <i class="ri-edit-line"></i>
                                                </div>
                                                <span>Modifier</span>
                                            </button>
                                            @endif
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('content.quiz.index', ['content' => $content->id]) }}"
                                                    class="flex items-center gap-1 text-[#7C3AED] hover:text-[#7C3AED]/80 text-sm transition-colors">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-questionnaire-line"></i>
                                                    </div>
                                                    <span>Quiz</span>
                                                </a>
                                                <a href="{{ route('content.details', ['id' => $content->id]) }}"
                                                    class="flex items-center gap-1 text-[#7C3AED] hover:text-[#7C3AED]/80 text-sm transition-colors">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-book-read-line"></i>
                                                    </div>
                                                    <span>Lire</span>
                                                </a>
                                            </div>
                                        </div>
                                        @if(Auth::user()->role == 'admin')

                                        @if($content->type == "anime" && !isset($content->anime))
                                            <a href="{{ route('anime.create', ['content_id' => $content->id]) }}"
                                                class="flex items-center justify-center gap-1 text-[#7C3AED] hover:text-[#7C3AED]/90 text-sm py-1.5 px-4 border border-[#7C3AED]/20 rounded-button transition-all hover:bg-[#7C3AED]/5">
                                                <div class="w-4 h-4 flex items-center justify-center">
                                                    <i class="ri-video-add-line"></i>
                                                </div>
                                                <span>Ajouter le contenu anime</span>
                                            </a>
                                        @elseif($content->type == "manga" && !isset($content->manga))
                                            <a href="{{ route('manga.create', ['content_id' => $content->id]) }}"
                                                class="flex items-center justify-center gap-1 text-[#7C3AED] hover:text-[#7C3AED]/90 text-sm py-1.5 px-4 border border-[#7C3AED]/20 rounded-button transition-all hover:bg-[#7C3AED]/5">
                                                <div class="w-4 h-4 flex items-center justify-center">
                                                    <i class="ri-book-open-line"></i>
                                                </div>
                                                <span>Ajouter le contenu manga</span>
                                            </a>
                                        @endif
                                        @endif
                                        @if(Auth::user()->role == 'admin')

                                        <button onClick="supprimerContent({{$content->id}})"
                                            class="w-full flex items-center justify-center gap-1 text-red-500 hover:text-red-600 text-sm py-1.5 px-4 border border-red-200 rounded-button transition-all hover:bg-red-50">
                                            <div class="w-4 h-4 flex items-center justify-center">
                                                <i class="ri-delete-bin-line"></i>
                                            </div>
                                            <span>Supprimer</span>
                                        </button>
                                        @endif
                                        @if(in_array($content->id, $bibliothequeIds))
                                            <form action="{{ route('bibliotheque.retirer', ['content_id' => $content->id]) }}"
                                                method="POST" class="flex justify-center">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-600 text-sm flex items-center gap-1 transition-colors !rounded-button">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </div>
                                                    <span>Retirer de la bibliothèque</span>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('bibliotheque.ajouter', ['content_id' => $content->id]) }}"
                                                method="POST" class="flex flex-col gap-2">
                                                @csrf
                                                <div class="relative">
                                                    <div
                                                        class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                                        <div class="w-4 h-4 flex items-center justify-center text-gray-400">
                                                            <i class="ri-bookmark-line"></i>
                                                        </div>
                                                    </div>
                                                    <select name="statut" required
                                                        class="w-full pl-8 pr-8 py-1.5 text-sm border border-gray-200 rounded-button appearance-none bg-white focus:ring-2 focus:ring-[#7C3AED] focus:border-[#7C3AED]">
                                                        <option value="en cours">En cours</option>
                                                        <option value="a voir">À voir</option>
                                                        <option value="termine">Terminé</option>
                                                    </select>
                                                    <div
                                                        class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                                        <div class="w-4 h-4 flex items-center justify-center text-gray-400">
                                                            <i class="ri-arrow-down-s-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="bg-[#7C3AED] hover:bg-[#7C3AED]/90 text-white text-sm py-1.5 px-4 rounded-button whitespace-nowrap transition-all flex items-center gap-1 justify-center">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-add-line"></i>
                                                    </div>
                                                    <span>Ajouter à ma bibliothèque</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-lg p-8 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center text-gray-400">
                            <i class="ri-inbox-line ri-3x"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">Aucun contenu disponible</h3>
                        <p class="text-gray-500">Il n'y a pas encore de contenu dans la bibliothèque</p>
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center text-gray-400">
                            <i class="ri-inbox-line ri-3x"></i>
                        </div>
                    </div>
                @endif
            </section>
    </main>
    <div id="modifierModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <form action="{{ route('content.update') }}" method="POST" id="modifierform"
            class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4">
            @csrf
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-900">Modifier le contenu</h3>
                <button type="button" onclick="closeModifierModal()" class="text-gray-400 hover:text-gray-500">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-close-line"></i>
                    </div>
                </button>
            </div>
            <input name="MID" id="MID" type="hidden">
            <div class="space-y-4">
                <div>
                    <label for="Mtitre" class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
                    <input type="text" id="Mtitre" name="Mtitre" placeholder="Titre du contenu"
                        class="w-full border-gray-300 border rounded-button py-2 px-4 focus:ring-2 focus:ring-[#7C3AED] focus:border-[#7C3AED] text-sm">
                </div>
                <div>
                    <label for="Mdescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="Mdescription" name="Mdescription" rows="4" placeholder="Description du contenu"
                        class="w-full border-gray-300 border rounded-button py-2 px-4 focus:ring-2 focus:ring-[#7C3AED] focus:border-[#7C3AED] text-sm"></textarea>
                </div>
                <div>
                    <label for="MdatePublication" class="block text-sm font-medium text-gray-700 mb-1">Date de
                        publication</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                <i class="ri-calendar-line"></i>
                            </div>
                        </div>
                        <input type="date" id="MdatePublication" name="MdatePublication"
                            class="pl-10 w-full border-gray-300 border rounded-button py-2 px-4 focus:ring-2 focus:ring-[#7C3AED] focus:border-[#7C3AED] text-sm">
                    </div>
                </div>
                <div>
                    <label for="Mcategory_id" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                <i class="ri-folder-line"></i>
                            </div>
                        </div>
                        <select name="Mcategory_id" id="Mcategory_id" required
                            class="pl-10 w-full border-gray-300 border rounded-button py-2 px-4 pr-8 focus:ring-2 focus:ring-[#7C3AED] focus:border-[#7C3AED] text-sm appearance-none bg-white">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nom }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                <i class="ri-arrow-down-s-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="Mtype" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                <i class="ri-film-line"></i>
                            </div>
                        </div>
                        <select name="Mtype" id="Mtype" required
                            class="pl-10 w-full border-gray-300 border rounded-button py-2 px-4 pr-8 focus:ring-2 focus:ring-[#7C3AED] focus:border-[#7C3AED] text-sm appearance-none bg-white">
                            <option value="anime">Anime</option>
                            <option value="manga">Manga</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                <i class="ri-arrow-down-s-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeModifierModal()"
                    class="text-gray-700 hover:text-gray-800 py-2 px-4 border border-gray-300 rounded-button whitespace-nowrap transition-all flex items-center gap-2">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-close-line"></i>
                    </div>
                    <span>Annuler</span>
                </button>
                <button type="submit"
                    class="bg-[#7C3AED] hover:bg-[#7C3AED]/90 text-white py-2 px-6 rounded-button whitespace-nowrap transition-all flex items-center gap-2">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-save-line"></i>
                    </div>
                    <span>Enregistrer</span>
                </button>
            </div>
        </form>
    </div>
    <footer class="bg-[#47146E] text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-2xl font-['Pacifico'] font-bold">蓮の花</h2>
                    <p class="text-[#F4C2C2] text-sm mt-1">Votre bibliothèque d'anime et manga préférés</p>
                </div>
                
            </div>
            <div class="border-t border-gray-700 mt-6 pt-6 text-center text-[#F4C2C2] text-sm">
                &copy; 2025 蓮の花. Tous droits réservés.
            </div>
        </div>
    </footer>
    <div id="deleteModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <form action="{{ route('content.delete') }}" method="POST" id="deleteform"
            class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4">
            @csrf
            <input type="hidden" id="DID" name="DID">
            <div class="text-center mb-6">
                <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center text-red-500">
                    <i class="ri-delete-bin-line ri-3x"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Confirmer la suppression</h3>
                <p class="text-gray-500">Êtes-vous sûr de vouloir supprimer ce contenu ? Cette action est irréversible.
                </p>
            </div>
            <div class="flex justify-center gap-3">
                <button type="button" onclick="closeDeleteModal()"
                    class="text-gray-700 hover:text-gray-800 py-2 px-4 border border-gray-300 rounded-button whitespace-nowrap transition-all flex items-center gap-2">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-close-line"></i>
                    </div>
                    <span>Annuler</span>
                </button>
                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded-button whitespace-nowrap transition-all flex items-center gap-2">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-delete-bin-line"></i>
                    </div>
                    <span>Supprimer</span>
                </button>
            </div>
        </form>
    </div>
    <script>
        function modifierContent(id, titre, description, datePublication, type, category_id) {
            document.getElementById('MID').value = id;
            document.getElementById('Mtitre').value = titre;
            document.getElementById('Mdescription').value = description;
            document.getElementById('MdatePublication').value = datePublication;
            document.getElementById('Mcategory_id').value = category_id;
            document.getElementById('modifierModal').classList.remove('hidden');
            document.getElementById('modifierModal').classList.add('flex');
        }
        function closeModifierModal() {
            document.getElementById('modifierModal').classList.add('hidden');
            document.getElementById('modifierModal').classList.remove('flex');
        }
        function supprimerContent(id) {
            document.getElementById('DID').value = id;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
            document.getElementById('addModal').classList.add('flex');
        }
        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
            document.getElementById('addModal').classList.remove('flex');
        }
        document.addEventListener('DOMContentLoaded', function () {

            const fileInput = document.getElementById('photo');
            const fileButton = fileInput.nextElementSibling;
            fileInput.addEventListener('change', function () {
                if (fileInput.files.length > 0) {
                    fileButton.textContent = fileInput.files[0].name;
                } else {
                    fileButton.textContent = 'Parcourir les fichiers';
                }
            });
        });
    </script>
</body>

</html>