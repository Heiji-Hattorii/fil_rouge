<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Bibliothèque d'Animes et Mangas</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }
        .toggle-checkbox:checked {
            right: 0;
            border-color: #6366f1;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #6366f1;
        }
        select {
            appearance: none;
            background-image: url("{{ asset('img/icons8-arrow-down-30.png') }}");
            background-repeat: no-repeat;
            background-position: right 0.5rem center;
            background-size: 1em;
            padding-right: 2.5rem;
        }
        .content-card {
            transition: all 0.3s ease;
        }
        .content-card:hover {
            transform: translateY(-3px);
        }
        .nav-item.active {
            color: #6366f1;
            border-color: #6366f1;
        }
        .nav-item:hover:not(.active) {
            color: #4f46e5;
        }
                #background-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: fill;
            z-index: -1;
            opacity: 0.5;
        }
    </style>
</head>
<body>
<video autoplay muted loop playsinline id="background-video">
        <source src="{{asset('img/japon100.mp4')}}" type="video/mp4">
        Ton navigateur ne supporte pas les vidéos HTML5.
    </video>
    <div class="min-h-screen bg-transparent">
    <header class="bg-black bg-opacity-75 shadow-sm">
            <div class="container mx-auto px-4 py-6 flex justify-between items-center">
                <h1 class="text-3xl font-['Pacifico'] text-white font-bold">蓮の花</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-white">Manga</span>
                    <div class="relative inline-block w-12 align-middle select-none">
                        <input type="checkbox" id="content-toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer transition-all duration-300 ease-in-out" />
                        <label for="content-toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer transition-all duration-300 ease-in-out"></label>
                    </div>
                    <span class="text-white">Anime</span>
                </div>
            </div>
        </header>

        <div class="container mx-auto px-4 py-8">
            <div class="bg-black bg-opacity-75 rounded-lg shadow-sm p-6 mb-8">
                <h2 class="text-2xl font-semibold text-white mb-6">Ajouter un contenu</h2>
                <form action="{{ route('bibliotheques.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="content_id" class="block text-sm font-medium text-white mb-2">Contenu</label>
                            <select name="content_id" id="content_id" required class="w-full px-4 py-2 border border-gray-300 rounded text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#6366f1] focus:border-transparent">
                                @foreach($contents as $content)
                                <option value="{{ $content->id }}">{{ $content->titre }} ({{ $content->type }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="statut" class="block text-sm font-medium text-white mb-2">Statut</label>
                            <select name="statut" id="statut" required class="w-full px-4 py-2 border border-gray-300 rounded text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#6366f1] focus:border-transparent">
                                <option value="en cours">En cours</option>
                                <option value="a voir">À voir</option>
                                <option value="termine">Terminé</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="!rounded-button bg-[#6366f1] hover:bg-indigo-600 text-white px-6 py-2 font-medium transition-all duration-200 flex items-center whitespace-nowrap">
                            <i class="ri-add-line mr-2"></i> Ajouter à ma bibliothèque
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-black bg-opacity-75 rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-white">Mes contenus</h2>
                    <div class="relative">
                        <div class="w-64 flex items-center border border-gray-300 rounded-full px-2 py-1">
                            <i class="ri-search-line text-white mr-2"></i>
                            <input type="text" id="search-content" placeholder="Rechercher..." class="w-full bg-balck bg-opacity-75 border-none focus:outline-none text-sm">
                        </div>
                    </div>
                </div>

                <nav class="flex border-b border-gray-200 mb-6">
                    <button class="nav-item px-4 py-2 font-medium text-gray-600 border-b-2 border-transparent active" data-status="all">Tous</button>
                    <button class="nav-item px-4 py-2 font-medium text-gray-600 border-b-2 border-transparent" data-status="en cours">En cours</button>
                    <button class="nav-item px-4 py-2 font-medium text-gray-600 border-b-2 border-transparent" data-status="a voir">À voir</button>
                    <button class="nav-item px-4 py-2 font-medium text-gray-600 border-b-2 border-transparent" data-status="termine">Terminé</button>
                </nav>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($bibliotheques as $bibliotheque)
                    <div class="content-card bg-purple-300 border border-gray-100 rounded-lg shadow-sm overflow-hidden" data-status="{{ $bibliotheque->statut }}" data-type="{{ $bibliotheque->content->type }}">
                        <div class="h-40 bg-gray-100 relative">
                            <div class="absolute top-2 right-2 bg-[#6366f1] text-white text-xs px-2 py-1 rounded-full">
                                {{ $bibliotheque->content->type }}
                            </div>
                            <div style="background-image: url(' {{ asset($bibliotheque->content->photo) }}'); background-size: cover; background-position: center; height: 100%;">
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $bibliotheque->content->titre }}</h3>
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <span class="w-3 h-3 rounded-full mr-2 {{ $bibliotheque->statut == 'en cours' ? 'bg-yellow-400' : ($bibliotheque->statut == 'termine' ? 'bg-green-400' : 'bg-blue-400') }}"></span>
                                    <span class="text-sm text-gray-600">
                                        {{ $bibliotheque->statut == 'en cours' ? 'En cours' : ($bibliotheque->statut == 'termine' ? 'Terminé' : 'À voir') }}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-500">Ajouté le 04/05/2025</div>
                            </div>
                            <div class="flex items-center justify-between">
                                <form action="{{ route('bibliotheques.update', $bibliotheque->id) }}" method="POST" class="flex-1 mr-2">
                                    @csrf
                                    @method('PUT')
                                    <select name="statut" onchange="this.form.submit()" class="w-full text-sm px-3 py-2 border border-gray-300 rounded !rounded-button focus:outline-none focus:ring-2 focus:ring-[#6366f1] focus:border-transparent">
                                        <option value="en cours" {{ $bibliotheque->statut == 'en cours' ? 'selected' : '' }}>En cours</option>
                                        <option value="a voir" {{ $bibliotheque->statut == 'a voir' ? 'selected' : '' }}>À voir</option>
                                        <option value="termine" {{ $bibliotheque->statut == 'termine' ? 'selected' : '' }}>Terminé</option>
                                    </select>
                                </form>
                                <form action="{{ route('bibliotheques.destroy', $bibliotheque->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="!rounded-button w-10 h-10 flex items-center justify-center bg-red-50 hover:bg-red-100 text-red-500 rounded transition-colors duration-200">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div id="empty-state" class="hidden text-center py-10">
                    <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-gray-100 rounded-full">
                        <i class="ri-inbox-line text-gray-400 ri-2x"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800 mb-1">Aucun contenu trouvé</h3>
                    <p class="text-gray-500">Aucun contenu ne correspond à vos critères de recherche.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contentToggle = document.getElementById('content-toggle');
            contentToggle.addEventListener('change', function() {
                filterContent();
            });
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    navItems.forEach(nav => nav.classList.remove('active'));
                    this.classList.add('active');
                    filterContent();
                });
            });

            const searchInput = document.getElementById('search-content');
            searchInput.addEventListener('input', function() {
                filterContent();
            });

            function filterContent() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedStatus = document.querySelector('.nav-item.active').getAttribute('data-status');
                const contentType = contentToggle.checked ? 'anime' : 'manga';
                
                const cards = document.querySelectorAll('.content-card');
                let visibleCount = 0;
                
                cards.forEach(card => {
                    const cardStatus = card.getAttribute('data-status');
                    const cardType = card.getAttribute('data-type');
                    const cardTitle = card.querySelector('h3').textContent.toLowerCase();
                    
                    const statusMatch = selectedStatus === 'all' || cardStatus === selectedStatus;
                    const typeMatch = contentType === 'all' || cardType === contentType;
                    const titleMatch = cardTitle.includes(searchTerm);
                    
                    if (statusMatch && typeMatch && titleMatch) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                const emptyState = document.getElementById('empty-state');
                if (visibleCount === 0) {
                    emptyState.classList.remove('hidden');
                } else {
                    emptyState.classList.add('hidden');
                }
            }
        });
    </script>
</body>
</html>