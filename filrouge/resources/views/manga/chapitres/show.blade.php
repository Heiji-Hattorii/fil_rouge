<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Chapitre - Manga</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <script>tailwind.config={theme:{extend:{colors:{primary:'#6D28D9',secondary:'#4C1D95'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    <style>
        :where([class^="ri-"])::before { content: "\f3c2"; }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0F172A;
            color: #F8FAFC;
        }
        .manga-card {
            background: linear-gradient(145deg, #1E293B, #1E293B);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
        }
        .comment-card {
            background: linear-gradient(145deg, #1E293B, #0F172A);
            transition: transform 0.3s ease;
        }
        .comment-card:hover {
            transform: translateY(-2px);
        }
        .btn-primary {
            background: linear-gradient(135deg, #6D28D9, #4C1D95);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #7C3AED, #5B21B6);
            transform: translateY(-1px);
        }
        .btn-danger {
            background: linear-gradient(135deg, #EF4444, #DC2626);
            transition: all 0.3s ease;
        }
        .btn-danger:hover {
            background: linear-gradient(135deg, #F87171, #EF4444);
            transform: translateY(-1px);
        }
        textarea:focus {
            outline: none;
            border-color: #6D28D9;
            box-shadow: 0 0 0 3px rgba(109, 40, 217, 0.2);
        }
    </style>
</head>
<body>
    @include('partials.header')
    
    <div class="container mx-auto px-4 py-8 max-w-5xl pt-20">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold text-white relative">
                Détails du Chapitre
                <span class="block h-1 w-24 bg-primary mt-2"></span>
            </h2>
            <a href="{{ route('manga.chapitres.index', ['manga_id' => $chapitre->manga_id]) }}" class="flex items-center text-gray-300 hover:text-primary transition-colors duration-300">
                <div class="w-8 h-8 flex items-center justify-center mr-1">
                    <i class="ri-arrow-left-line ri-lg"></i>
                </div>
                <span>Retour</span>
            </a>
        </div>
        
        <div class="manga-card rounded-lg p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex flex-col">
                    <span class="text-gray-400 text-sm mb-1">ID du Chapitre</span>
                    <span class="text-xl font-semibold">{{ $chapitre->id }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-400 text-sm mb-1">Nombre de Pages</span>
                    <span class="text-xl font-semibold">{{ $chapitre->nbr_pages }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-400 text-sm mb-1">Date d'Ajout</span>
                    <span class="text-xl font-semibold">{{ $chapitre->date_ajout }}</span>
                </div>
            </div>
            
            <div class="mt-8">
                <form method="POST" action="{{ $deja_ajoute ? route('chapitre.removeView', $chapitre->id) : route('chapitre.addView', $chapitre->id) }}">
                    @csrf
                    <button type="submit" class="whitespace-nowrap !rounded-button px-6 py-3 font-medium flex items-center {{ $deja_ajoute ? 'btn-danger' : 'btn-primary' }}">
                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                            <i class="{{ $deja_ajoute ? 'ri-eye-off-line' : 'ri-eye-line' }}"></i>
                        </div>
                        {{ $deja_ajoute ? 'Retirer de mes vues' : 'Ajouter à mes vues' }}
                    </button>
                </form>
            </div>
        </div>
        
        <div class="mb-12">
            <h3 class="text-2xl font-bold mb-6 flex items-center">
                <div class="w-6 h-6 flex items-center justify-center mr-2">
                    <i class="ri-chat-3-line"></i>
                </div>
                Commentaires
            </h3>
            
            @if($comments->isEmpty())
                <div class="bg-gray-800/50 rounded-lg p-8 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center text-gray-500">
                        <i class="ri-chat-off-line ri-3x"></i>
                    </div>
                    <p class="text-gray-400 text-lg">Aucun commentaire pour ce chapitre.</p>
                    <p class="text-gray-500 mt-2">Soyez le premier à partager votre avis !</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($comments as $comment)
                        <div class="comment-card rounded-lg p-5 border border-gray-800">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center mr-3">
                                    <span class="text-primary font-bold">{{ substr($comment->user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h4 class="font-medium text-white">{{ $comment->user->name }}</h4>
                                    <p class="text-xs text-gray-400">
                                        <span class="flex items-center">
                                            <div class="w-3 h-3 flex items-center justify-center mr-1">
                                                <i class="ri-time-line"></i>
                                            </div>
                                            {{ $comment->created_at->format('d/m/Y H:i:s') }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="pl-13">
                                <p class="text-gray-300">{{ $comment->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        
        <div class="bg-gray-800/30 rounded-lg p-6 border border-gray-700">
            <h3 class="text-xl font-bold mb-4 flex items-center">
                <div class="w-5 h-5 flex items-center justify-center mr-2">
                    <i class="ri-edit-line"></i>
                </div>
                Ajouter un commentaire
            </h3>
            
            <form action="{{ route('commentaire.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="content_id" value="{{ $chapitre->manga->content_id }}">
                <input type="hidden" name="chapitre_id" value="{{ $chapitre->id }}">
                
                <div>
                    <textarea 
                        name="comment" 
                        placeholder="Partagez votre avis sur ce chapitre..." 
                        required 
                        class="w-full bg-gray-900 border-none rounded-lg p-4 text-gray-100 placeholder-gray-500 focus:ring-2 focus:ring-primary/50"
                        rows="4"
                    ></textarea>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="whitespace-nowrap !rounded-button px-6 py-3 btn-primary flex items-center">
                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                            <i class="ri-send-plane-line"></i>
                        </div>
                        Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const commentCards = document.querySelectorAll('.comment-card');
            commentCards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.classList.add('shadow-lg');
                });
                card.addEventListener('mouseleave', () => {
                    card.classList.remove('shadow-lg');
                });
            });
        });
    </script>
</body>
</html>