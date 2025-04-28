<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Anime</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #2D1B3D;

        }
        .anime-header {
            background-image: url({{ asset('img/jj.jpg') }});
            background-size: cover;
            background-position: center;
        }
        .anime-card {
            transition: all 0.3s ease;
        }
        .anime-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(107, 70, 193, 0.2);
        }
        .comment-bubble {
            position: relative;
            border-radius: 18px;
        }
        .comment-bubble::after {
            content: '';
            position: absolute;
            left: -10px;
            top: 15px;
            border-width: 10px 10px 0 0;
            border-style: solid;
            border-color: transparent #fff transparent transparent;
        }
        .star {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        #background-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: fill;
            z-index: -1;
            opacity: 0.50;
        }
        .star:hover {
            transform: scale(1.2);
        }
        .rating-stars .star:hover ~ .star {
            color: #d1d5db;
        }
        input[type="hidden"] {
            display: none;
        }
    </style>
</head>
<body>
<video autoplay muted loop playsinline id="background-video">
        <source src="{{asset('img/japon100.mp4')}}" type="video/mp4">
        Ton navigateur ne supporte pas les vidéos HTML5.
    </video>
    
    <div class="anime-header relative w-full h-64 md:h-40 flex items-center justify-center mb-8">
        <div class="absolute inset-0 bg-[#6B46C1] bg-opacity-60"></div>
        <div class="relative z-10 text-center px-4">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-2">{{ $anime->content->titre }}</h1>
            <div class="flex justify-center items-center space-x-2 mt-4">
                <div class="bg-white bg-opacity-90 px-4 py-2 rounded-full flex items-center">
                    <div class="flex items-center mr-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star text-2xl {{ $i <= ($averageRating ?? 0) ? 'text-[#F6E05E]' : 'text-gray-300' }}">&#9733;</span>
                        @endfor
                    </div>
                    <span class="font-bold text-black">{{ $averageRating ?? 'Pas encore noté' }}</span>
                </div>
                <a href="{{ route('anime.episodes.index', ['anime_id' => $anime->id]) }}" class="bg-[#6B46C1] hover:bg-opacity-90 text-white font-bold py-2 px-6 rounded-button flex items-center transition-all duration-300 shadow-lg">
                    <i class="ri-play-circle-line mr-2"></i>
                    <span class="whitespace-nowrap">Voir les épisodes</span>
                </a>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 max-w-6xl">
        <div class="flex items-center mb-8 text-sm">
            <a href="{{ route('content.index') }}" class="flex items-center text-white hover:text-[#6B46C1] transition-colors">
                <i class="ri-home-line mr-1"></i>
                <span>Accueil</span>
            </a>
            <i class="ri-arrow-right-s-line mx-2 text-gray-400"></i>
            <span class="text-[#6B46C1] font-medium">{{ $anime->content->titre }}</span>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <div class="w-full lg:w-2/3">
                <div class="bg-black bg-opacity-70 rounded-lg shadow-md p-6 mb-8">
                    <h2 class="text-2xl font-bold text-white mb-4">Description</h2>
                    <p class="text-violet-300 leading-relaxed">{{ $anime->content->description }}</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
                    <div class="anime-card bg-black bg-opacity-70 p-4 rounded-lg shadow-md">
                        <div class="w-10 h-10 flex items-center justify-center bg-[#6B46C1] bg-opacity-10 rounded-full mb-3">
                            <i class="ri-movie-line text-[#6B46C1]"></i>
                        </div>
                        <h3 class="text-xl text-white">Type</h3>
                        <p class="font-medium text-violet-300">{{ $anime->content->type }}</p>
                    </div>
                    
                    <div class="anime-card bg-black bg-opacity-70 p-4 rounded-lg shadow-md">
                        <div class="w-10 h-10 flex items-center justify-center bg-[#6B46C1] bg-opacity-10 rounded-full mb-3">
                            <i class="ri-film-line text-[#6B46C1]"></i>
                        </div>
                        <h3 class="text-xl text-white">Genre</h3>
                        <p class="font-medium text-violet-300">{{ $anime->content->category->nom  }}</p>
                    </div>
                    
                    <div class="anime-card bg-black bg-opacity-70 p-4 rounded-lg shadow-md">
                        <div class="w-10 h-10 flex items-center justify-center bg-[#6B46C1] bg-opacity-10 rounded-full mb-3">
                            <i class="ri-tv-line text-[#6B46C1]"></i>
                        </div>
                        <h3 class="text-xl text-white">Épisodes</h3>
                        <p class="font-medium text-violet-300">{{ $anime->nbr_episodes }}</p>
                    </div>
                    
                    <div class="anime-card bg-black bg-opacity-70 p-4 rounded-lg shadow-md">
                        <div class="w-10 h-10 flex items-center justify-center bg-[#6B46C1] bg-opacity-10 rounded-full mb-3">
                            <i class="ri-stack-line text-[#6B46C1]"></i>
                        </div>
                        <h3 class="text-xl text-white">Saisons</h3>
                        <p class="font-medium text-violet-300">{{ $anime->nbr_saisons }}</p>
                    </div>
                    
                    <div class="anime-card bg-black bg-opacity-70 p-4 rounded-lg shadow-md">
                        <div class="w-10 h-10 flex items-center justify-center bg-[#6B46C1] bg-opacity-10 rounded-full mb-3">
                            <i class="ri-calendar-line text-[#6B46C1]"></i>
                        </div>
                        <h3 class="text-xl text-white">Diffusion</h3>
                        <p class="font-medium text-violet-300">{{ $anime->date_debut }} - {{ $anime->date_fin }}</p>
                    </div>
                    
                    <div class="anime-card bg-black bg-opacity-70 p-4 rounded-lg shadow-md">
                        <div class="w-10 h-10 flex items-center justify-center bg-[#6B46C1] bg-opacity-10 rounded-full mb-3">
                            <i class="ri-user-line text-[#6B46C1]"></i>
                        </div>
                        <h3 class="text-xl text-white">Producteur</h3>
                        <p class="font-medium text-violet-300">{{ $anime->producteur }}</p>
                    </div>
                </div>

                <div class="bg-black bg-opacity-70 rounded-lg shadow-md p-6 mb-8">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                        <i class="ri-chat-3-line mr-2 text-[#6B46C1]"></i>
                        Commentaires
                    </h2>
                    
                    @if(count($comments) > 0)
                        <div class="space-y-4 mb-8">
                            @foreach($comments as $comment)
                                <div class="flex">
                                    <div class="w-10 h-10 flex-shrink-0 rounded-full bg-[#6B46C1] text-white flex items-center justify-center">
                                        {{ substr($comment->user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="comment-bubble bg-black bg-opacity-70 border border-gray-100 p-4 shadow-sm">
                                            <div class="flex justify-between items-start mb-2">
                                                <span class="font-bold text-white">{{ $comment->user->name }}</span>
                                                <span class="text-xs text-white">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
                                            </div>
                                            <p class="text-violet-300">{{ $comment->comment }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-white">
                            <i class="ri-chat-off-line text-4xl mb-2 block"></i>
                            <p>Aucun commentaire pour le moment. Soyez le premier à donner votre avis !</p>
                        </div>
                    @endif
                    
                    @if(Auth::check())
                        <div class="border-t pt-6">
                            <h3 class="text-lg font-semibold mb-4 text-white">Ajouter un commentaire</h3>
                            <form action="{{ route('commentaire.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="content_id" value="{{ $anime->content->id }}">
                                <div>
                                    <label for="comment" class="block text-sm font-medium text-violet-300 mb-1">Votre commentaire</label>
                                    <textarea id="comment" name="comment" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#6B46C1] focus:border-[#6B46C1] resize-none" required></textarea>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-[#6B46C1] hover:bg-opacity-90 text-white font-bold py-2 px-6 rounded-button flex items-center transition-all duration-300 !rounded-button whitespace-nowrap">
                                        <i class="ri-send-plane-line mr-2"></i>
                                        Publier
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <p class="text-white mb-2">Connectez-vous pour laisser un commentaire</p>
                            <a href="/login" class="inline-block bg-[#6B46C1] bg-opacity-10 text-[#6B46C1] font-medium py-2 px-4 rounded-button hover:bg-opacity-20 transition-colors !rounded-button whitespace-nowrap">Se connecter</a>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="w-full lg:w-1/3">
                <div class="bg-black bg-opacity-70 rounded-lg shadow-md overflow-hidden mb-8">
                    <img src="{{ asset($anime->content->photo) }}" class="w-full h-auto object-cover">
                </div>
                
                <!-- Notation -->
                <div class="bg-black bg-opacity-70 rounded-lg shadow-md p-6 mb-8">
                    <h2 class="text-xl font-bold text-white mb-4 flex items-center">
                        <i class="ri-star-line mr-2 text-[#6B46C1]"></i>
                        Note globale
                    </h2>
                    
                    <div class="flex items-center justify-center mb-4">
                        <div class="flex">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star text-4xl {{ $i <= ($averageRating ?? 0) ? 'text-[#F6E05E]' : 'text-gray-300' }}">&#9733;</span>
                            @endfor
                        </div>
                        <span class="ml-3 text-2xl font-bold text-white">{{ $averageRating ?? '0' }}/5</span>
                    </div>
                    
                    @if(Auth::check())
                        <div class="border-t pt-4">
                            <h3 class="text-lg font-medium mb-3 text-violet-300">Votre évaluation</h3>
                            <form action="{{ route('notation.store', ['contentId' => $anime->content->id]) }}" method="POST" onsubmit="return validateRating()">
                                @csrf
                                <div class="flex justify-center mb-4 rating-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="star text-3xl text-gray-300 hover:text-[#F6E05E]" data-value="{{ $i }}" onclick="setRating(this, {{ $i }})">&#9733;</span>
                                    @endfor
                                </div>
                                <input type="hidden" name="note" id="note" value="0" />
                                <button type="submit" class="w-full bg-[#6B46C1] hover:bg-opacity-90 text-white font-bold py-2 px-4 rounded-button flex items-center justify-center transition-all duration-300 !rounded-button whitespace-nowrap">
                                    <i class="ri-star-line mr-2"></i>
                                    Soumettre ma note
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <p class="text-white mb-2">Connectez-vous pour noter cet anime</p>
                            <a href="/login" class="inline-block bg-[#6B46C1] bg-opacity-10 text-[#6B46C1] font-medium py-2 px-4 rounded-button hover:bg-opacity-20 transition-colors !rounded-button whitespace-nowrap">Se connecter</a>
                        </div>
                    @endif
                </div>
                
                <!-- Informations supplémentaires -->
                <div class="bg-black bg-opacity-70 rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-white mb-4 flex items-center">
                        <i class="ri-information-line mr-2 text-[#6B46C1]"></i>
                        Informations
                    </h2>
                    
                    <ul class="space-y-3">
                        <li class="flex justify-between">
                            <span class="text-white">Date de publication</span>
                            <span class="font-medium text-violet-300">{{ $anime->content->datePublication }}</span>
                        </li>
                        <li class="flex justify-between border-t pt-3">
                            <span class="text-white">Type</span>
                            <span class="font-medium text-violet-300">{{ $anime->content->type }}</span>
                        </li>
                        <li class="flex justify-between border-t pt-3">
                            <span class="text-white">Genre</span>
                            <span class="font-medium text-violet-300">{{ $anime->content->category->nom }}</span>
                        </li>
                        <li class="flex justify-between border-t pt-3">
                            <span class="text-white">Épisodes</span>
                            <span class="font-medium text-violet-300">{{ $anime->nbr_episodes }}</span>
                        </li>
                        <li class="flex justify-between border-t pt-3">
                            <span class="text-white">Saisons</span>
                            <span class="font-medium text-violet-300">{{ $anime->nbr_saisons }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setRating(element, value) {
            document.getElementById('note').value = value;
            
            // Reset all stars
            const stars = document.querySelectorAll('.rating-stars .star');
            stars.forEach(star => {
                star.classList.remove('text-[#F6E05E]');
                star.classList.add('text-gray-300');
            });
            
            for (let i = 0; i < stars.length; i++) {
                if (i < value) {
                    stars[i].classList.remove('text-gray-300');
                    stars[i].classList.add('text-[#F6E05E]');
                }
            }
        }
        
        function validateRating() {
            const rating = document.getElementById('note').value;
            if (rating === '0') {
                alert('Veuillez sélectionner une note entre 1 et 5 étoiles.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>