<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>蓮の花< - Votre portail d'anime et manga</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .hero-section {
            background-image: url("{{ asset('img/japon4.jpg') }}");
            background-size: cover;
            background-position: bottom;
        }

        .custom-switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }

        .custom-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
    </style>
</head>

<body class="bg-gray-50">
@include('partials.header')

    <main class="pt-16">
        <section class="hero-section relative">
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-transparent"></div>
            <div class="container mx-auto px-4 py-20 md:py-32 relative z-10">
                <div class="max-w-xl">
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Découvrez l'univers des animes et mangas
                    </h1>
                    <p class="text-lg text-gray-200 mb-8">Explorez notre vaste collection d'animes et de mangas. Suivez
                        vos séries préférées et découvrez de nouveaux titres captivants.</p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('content.index') }}"
                            class="px-6 py-3 bg-[#8A2BE2] text-white rounded-button whitespace-nowrap font-medium hover:bg-[#8A2BE2]/90 transition-colors">Explorer
                            la collection</a>
                        <button
                            class="px-6 py-3 bg-white/20 backdrop-blur-sm text-white border border-white/40 rounded-button whitespace-nowrap font-medium hover:bg-white/30 transition-colors">En
                            savoir plus</button>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Tendances du moment</h2>
                    <a href="{{ route('content.index') }}" class="text-[#8A2BE2] font-medium flex items-center">
                        Voir tout
                        <div class="w-5 h-5 ml-1 flex items-center justify-center">
                            <i class="ri-arrow-right-line"></i>
                        </div>
                    </a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($contents as $content)
                                    <div
                                        class="bg-white rounded shadow-sm overflow-hidden transition-transform hover:translate-y-[-4px]">
                                        <div class="relative aspect-[3/4]">
                                            <img src="{{ asset($content->photo) }}" alt="{{ $content->titre }}"
                                                class="w-full h-full object-cover object-top">
                                            <div class="absolute top-2 right-2 bg-[#c0428a] text-white text-xs px-2 py-1 rounded-full">
                                                {{ round($content->notations->avg('note'), 1) }} ★
                                            </div>
                                        </div>
                                        <div class="p-4">
                                            <h3 class="font-semibold text-gray-900 mb-1">{{ $content->titre }}</h3>
                                            <p class="text-sm text-gray-600 mb-2">{{ $content->category->nom }}</p>
                                            <div class="flex justify-between items-center">
                                                <span class="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full">
                                                    @auth
                                                        @php
                                                            $bibliotheque = auth()->user()->bibliotheques->where('content_id', $content->id)->first();
                                                        @endphp

                                                        @if($bibliotheque)
                                                            {{ $bibliotheque->statut }}
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
                                                @endauth
                                                </span>

@php
    $isLiked = $content->likes->contains('user_id', auth()->id());
@endphp

@if ($isLiked)
    <form action="{{ route('like.remove', $content->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-8 h-8 flex items-center justify-center text-red-500">
            <i class="ri-heart-fill"></i> 
        </button>
    </form>
@else
    <form action="{{ route('like.add', $content->id) }}" method="POST">
        @csrf
        <button type="submit" class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-[#8A2BE2]">
            <i class="ri-heart-line"></i> 
        </button>
    </form>
@endif

                                            </div>
                                        </div>
                                    </div>
                    @endforeach
                </div>

            </div>
        </section>
        <section class="py-12 bg-gray-50">
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Explorez par catégorie</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach ($categories as $category)
                    <a href="#" class="bg-white rounded shadow-sm p-4 text-center hover:shadow-md transition-shadow">
                        <div
                            class="w-12 h-12 mx-auto mb-3 bg-[#8A2BE2]/10 rounded-full flex items-center justify-center text-[#8A2BE2]">
                            <i class="{{ $category->icone }} text-3xl"></i>
                        </div>
                        <h3 class="font-medium text-gray-900">{{ $category->nom }}</h3>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Derniers mangas ajoutés</h2>
                    <div class="flex items-center space-x-2">
                        <button
                            class="px-4 py-1 bg-gray-100 text-gray-700 rounded-full whitespace-nowrap text-sm font-medium active:bg-[#8A2BE2] active:text-white">Tous</button>
                        <button
                            class="px-4 py-1 bg-[#8A2BE2] text-white rounded-full whitespace-nowrap text-sm font-medium">Shonen</button>
                        <button
                            class="px-4 py-1 bg-gray-100 text-gray-700 rounded-full whitespace-nowrap text-sm font-medium">Shojo</button>
                        <button
                            class="px-4 py-1 bg-gray-100 text-gray-700 rounded-full whitespace-nowrap text-sm font-medium">Seinen</button>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach($contents as $content)
                    @if($content->type == "manga")
                    <div
                        class="bg-white rounded shadow-sm overflow-hidden transition-transform hover:translate-y-[-4px]">
                        <div class="relative aspect-[3/4]">
                            <img src="{{ asset($content->photo) }}"
                                alt="" class="w-full h-full object-cover object-top">
                            <div class="absolute top-2 right-2 bg-[#c0428a] text-white text-xs px-2 py-1 rounded-full">
                            {{ round($content->notations->avg('note'), 1) }}★</div>
                        </div>
                        <div class="p-3">
                            <h3 class="font-semibold text-gray-900 mb-1">{{ $content->titre }}</h3>
                            <p class="text-xs text-gray-600">{{$content->datePublication}}</p>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </section>

    </main>
    <footer class="bg-[#47146E] text-[#F4C2C2] py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <a href="#" class="text-3xl font-['Pacifico'] text-white mb-4 inline-block font-bold">蓮の花</a>
                    <p class="mb-4">Votre portail pour découvrir et suivre les meilleurs animes et mangas.</p>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition-colors">Anime</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Manga</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Nouveautés</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Top Classements</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Catégories</h3>
                    @foreach ($categories as $cat )
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition-colors">{{$cat->nom}}</a></li>
                    </ul>
                    @endforeach
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm">
                <p>© 2025 Hasu Nu Hana. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
   
</body>

</html>