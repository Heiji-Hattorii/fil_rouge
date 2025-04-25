<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #2D1B3D;
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
        h1,
        h2,
        h3,
        h4 {
            font-family: 'Bangers', cursive;
        }

        .cadre {
            background: rgba(45, 27, 61, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        .profile-stats:hover {
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="min-h-screen text-gray-200">
    <video autoplay muted loop playsinline id="background-video">
        <source src="{{asset('img/japon100.mp4')}}" type="video/mp4">
        Ton navigateur ne supporte pas les vidéos HTML5.
    </video>
    <div class="relative">
        @if(Auth::user()->cover_photo)
            <div class="w-full h-64 overflow-hidden">
                <img src="{{ asset(Auth::user()->cover_photo) }}" alt="Photo de couverture"
                    class="w-full h-full object-cover">
            </div>
        @else
            <div
                class="w-full h-64 bg-gradient-to-r from-[#2A2D43] via-[#373B5A] to-[#2A2D43] flex items-center justify-center">
                <div class="text-center text-gray-500">
                    <div class="w-12 h-12 flex items-center justify-center mx-auto mb-2">
                        <i class="ri-image-line ri-2x text-[#FF6B6B]"></i>
                    </div>
                    <p>Aucune image de couverture</p>
                </div>
            </div>
        @endif
        <div class="absolute left-10 -bottom-16 border-4 border-[#2A2D43] rounded-full">
            @if(Auth::user()->profile_photo)
                <img src="{{ asset(Auth::user()->profile_photo) }}" alt="Photo de profil"
                    class="w-32 h-32 rounded-full object-cover">
            @else
                <div
                    class="w-32 h-32 rounded-full bg-gradient-to-br from-[#4B0082] to-[#8A2BE2] flex items-center justify-center">
                    <span class="text-4xl font-bold text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
            @endif
        </div>
        <div class="absolute right-6 bottom-6 flex space-x-3">
            <a href="{{ route('profile.edit') }}"
                class="flex items-center bg-blue-400 rounded-xl hover:bg-opacity-80 text-white px-4 py-2 !rounded-button whitespace-nowrap transition-all">
                <div class="w-5 h-5 flex items-center justify-center mr-2">
                    <i class="ri-edit-line text-blue-800"></i>
                </div>
                Modifier
            </a>
        </div>
    </div>
    <div class="container mx-auto px-4 pt-24 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="cadre rounded-lg p-6 shadow-xl">
                    <h1 class="text-4xl text-[#8A2BE2] mb-6">{{ Auth::user()->name }}</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="profile-stats gradient-border rounded-lg p-5 bg-opacity-30 bg-black">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 flex items-center justify-center mr-3 text-[#4B0082]">
                                    <i class="ri-at-line ri-lg text-[#4B0082]"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-300">Email</h3>
                            </div>
                            <p class="text-white pl-11">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="profile-stats gradient-border rounded-lg p-5 bg-opacity-30 bg-black">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 flex items-center justify-center mr-3 text-[#4B0082]">
                                    <i class="ri-user-line ri-lg text-[#4B0082]"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-300">Pseudo</h3>
                            </div>
                            <p class="text-white pl-11">{{ Auth::user()->pseudo }}</p>
                        </div>
                        <div class="profile-stats gradient-border rounded-lg p-5 bg-opacity-30 bg-black">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 flex items-center justify-center mr-3 text-[#4B0082]">
                                    <i class="ri-calendar-line ri-lg"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-300">Âge</h3>
                            </div>
                            <p class="text-white pl-11">{{ Auth::user()->age }} ans</p>
                        </div>
                        <div class="profile-stats gradient-border rounded-lg p-5 bg-opacity-30 bg-black">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 flex items-center justify-center mr-3 text-[#4B0082]">
                                    <i class="ri-heart-line ri-lg"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-300">Animés favoris</h3>
                            </div>
                            <p class="text-white pl-11">Pas encore ajouté</p>
                        </div>
                    </div>
                    <div class="mt-8 profile-stats gradient-border rounded-lg p-5 bg-opacity-30 bg-black">
                        <div class="flex items-center mb-3">
                            <div class="w-8 h-8 flex items-center justify-center mr-3 text-[#4B0082]">
                                <i class="ri-file-list-line ri-lg"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-300">Bio</h3>
                        </div>
                        <div class="pl-11">
                            @if(Auth::user()->bio)
                                <p class="text-white">{{ Auth::user()->bio }}</p>
                            @else
                                <p class="text-gray-400 italic">Aucune biographie ajoutée</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="cadre rounded-lg p-6 shadow-xl mb-6">
                    <h2 class="text-2xl text-[#8A2BE2] mb-4">Statistiques</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-3 bg-black bg-opacity-30 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 flex items-center justify-center mr-3 text-[#8A2BE2]">
                                    <i class="ri-eye-line ri-lg  text-[#FF6B6B]"></i>
                                </div>
                                <span>Animés vus</span>
                            </div>
                            <span class="text-xl font-bold">0</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-black bg-opacity-30 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 flex items-center justify-center mr-3 text-[#8A2BE2]">
                                    <i class="ri-book-open-line ri-lg  text-[#FF6B6B]"></i>
                                </div>
                                <span>Mangas lus</span>
                            </div>
                            <span class="text-xl font-bold">0</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-black bg-opacity-30 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 flex items-center justify-center mr-3 text-[#8A2BE2]">
                                    <i class="ri-star-line ri-lg  text-[#FF6B6B]"></i>
                                </div>
                                <span>Évaluations</span>
                            </div>
                            <span class="text-xl font-bold">0</span>
                        </div>
                    </div>
                </div>
                <div class="cadre rounded-lg p-6 shadow-xl">
                    <h2 class="text-2xl text-[#8A2BE2] mb-4 ">Actions du compte</h2>
                    <div class="space-y-4">
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center justify-between w-full p-3 bg-[#4B0082] bg-opacity-20 hover:bg-opacity-30 rounded-lg transition-all">
                            <div class="flex items-center">
                                <div class="w-8 h-8 flex items-center justify-center mr-3">
                                    <i class="ri-user-settings-line ri-lg  text-[#FF6B6B]"></i>
                                </div>
                                <span>Modifier mon profil</span>
                            </div>
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-arrow-right-s-line"></i>
                            </div>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit"
                                class="flex items-center justify-between w-full p-3 bg-black bg-opacity-30 hover:bg-opacity-50 rounded-lg transition-all !rounded-button whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 flex items-center justify-center mr-3 text-[#8A2BE2]">
                                        <i class="ri-logout-box-line ri-lg  text-[#FF6B6B]"></i>
                                    </div>
                                    <span>Déconnexion</span>
                                </div>
                                <div class="w-6 h-6 flex items-center justify-center">
                                    <i class="ri-arrow-right-s-line  text-[#FF6B6B]"></i>
                                </div>
                            </button>
                        </form>
                        <form action="{{ route('profile.delete') }}" method="POST" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer définitivement votre compte ?');"
                                class="flex items-center justify-between w-full p-3 bg-[#8A2BE2] bg-opacity-20 hover:bg-opacity-30 rounded-lg transition-all !rounded-button whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 flex items-center justify-center mr-3 text-[#8A2BE2]">
                                        <i class="ri-delete-bin-line ri-lg  text-[#FF6B6B]"></i>
                                    </div>
                                    <span>Supprimer mon compte</span>
                                </div>
                                <div class="w-6 h-6 flex items-center justify-center">
                                    <i class="ri-arrow-right-s-line"></i>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="py-6 text-center text-gray-400 text-sm">
        <p>© 2025 AnimeManga - Tous droits réservés</p>
    </footer>
</body>

</html>