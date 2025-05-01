<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Épisode {{ $episode->numero_episode }}</title>
<script src="https://cdn.tailwindcss.com/3.4.16"></script>
<script>tailwind.config={theme:{extend:{colors:{primary:'#8b5cf6',secondary:'#c084fc'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
<style>
:where([class^="ri-"])::before { content: "\f3c2"; }
body {
font-family: 'Poppins', sans-serif;
background-color: #f9fafb;
color: #1f2937;
}
.anime-title {
font-family: 'Poppins', sans-serif;
background: linear-gradient(90deg, #8b5cf6, #c084fc);
-webkit-background-clip: text;
background-clip: text;
color: transparent;
text-shadow: 0px 2px 4px rgba(139, 92, 246, 0.2);
}
.video-container {
box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
background: #111827;
position: relative;
overflow: hidden;
}
video::-webkit-media-controls-panel {
background-color: rgba(17, 24, 39, 0.7);
}
.comment-card {
transition: all 0.3s ease;
}
.comment-card:hover {
transform: translateY(-2px);
}
textarea {
transition: all 0.3s ease;
border: 2px solid #e5e7eb;
}
textarea:focus {
border-color: #8b5cf6;
box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
outline: none;
}
button {
transition: all 0.2s ease;
}
button:hover {
transform: translateY(-1px);
}
button:active {
transform: translateY(1px);
}
.section-divider {
height: 3px;
background: linear-gradient(90deg, transparent, #8b5cf6, transparent);
}
</style>
</head>
<body>
@include('partials.header')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 py-8 min-h-screen">
<div class="mb-10">
<h1 class="anime-title text-4xl sm:text-5xl font-bold text-center mb-8">Épisode {{ $episode->numero_episode }}</h1>
<div class="video-container rounded-xl overflow-hidden mb-6">
<video class="w-full max-h-[70vh] bg-black" controls>
<source src="{{ asset($episode->contenu) }}" type="video/mp4">
Votre navigateur ne supporte pas la lecture de vidéos.
</video>
</div>
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
<p class="text-gray-600 font-medium">
<span class="inline-flex items-center justify-center w-6 h-6 mr-2 text-primary">
<i class="ri-calendar-line"></i>
</span>
Ajouté le {{ $episode->date_ajout }}
</p>
<div class="flex flex-wrap gap-3">
<a href="{{ route('anime.episodes.index', $episode->anime_id) }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-button !rounded-button whitespace-nowrap transition-all">
<span class="inline-flex items-center justify-center w-5 h-5 mr-2">
<i class="ri-arrow-left-line"></i>
</span>
Retour aux épisodes
</a>
<form method="POST" action="{{ $dejaAjoute ? route('episode.removeView', [$episode->anime_id, $episode->id]) : route('episode.addView', [$episode->anime_id, $episode->id]) }}">
@csrf
<button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 bg-primary hover:bg-primary/90 text-white font-medium rounded-button !rounded-button whitespace-nowrap transition-all">
<span class="inline-flex items-center justify-center w-5 h-5 mr-2">
<i class="{{ $dejaAjoute ? 'ri-eye-off-line' : 'ri-eye-line' }}"></i>
</span>
{{ $dejaAjoute ? 'Retirer de mes vues' : 'Ajouter à mes vues' }}
</button>
</form>
</div>
</div>
</div>
<div class="section-divider my-8 rounded-full"></div>
<div class="mb-12">
<h2 class="text-2xl font-bold mb-6 flex items-center">
<span class="inline-flex items-center justify-center w-7 h-7 mr-2 text-primary">
<i class="ri-chat-3-line"></i>
</span>
Commentaires
</h2>
@if ($comments->isEmpty())
<div class="bg-white rounded-xl p-8 text-center shadow-sm border border-gray-100">
<div class="inline-flex items-center justify-center w-16 h-16 mb-4 text-gray-300 bg-gray-50 rounded-full">
<i class="ri-chat-off-line ri-2x"></i>
</div>
<p class="text-gray-500">Aucun commentaire pour cet épisode pour l'instant.</p>
<p class="text-gray-400 text-sm mt-2">Soyez le premier à partager votre avis !</p>
</div>
@else
<div class="space-y-4">
@foreach ($comments as $comment)
<div class="comment-card bg-white rounded-xl p-5 shadow-sm border border-gray-100">
<div class="flex items-start gap-3">
<div class="inline-flex items-center justify-center w-10 h-10 bg-primary/10 text-primary rounded-full flex-shrink-0">
<i class="ri-user-line"></i>
</div>
<div class="flex-1">
<p class="text-gray-800 mb-2">{{ $comment->comment }}</p>
<p class="text-xs text-gray-500">Posté le {{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y à H:i') }}</p>
</div>
</div>
</div>
@endforeach
</div>
@endif
</div>
<div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-10">
<h3 class="text-xl font-semibold mb-4 flex items-center">
<span class="inline-flex items-center justify-center w-6 h-6 mr-2 text-primary">
<i class="ri-chat-new-line"></i>
</span>
Ajouter un commentaire
</h3>
<form method="POST" action="{{ route('commentaire.store') }}" class="space-y-4">
@csrf
<input type="hidden" name="content_id" value="{{ $episode->anime->content_id }}">
<input type="hidden" name="episode_id" value="{{ $episode->id }}">
<div>
<textarea
name="comment"
placeholder="Partagez votre avis sur cet épisode..."
required
class="w-full min-h-[120px] p-4 rounded-lg border-none focus:ring-2 focus:ring-primary/20 bg-gray-50"
></textarea>
</div>
<div class="flex justify-end">
<button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-primary hover:bg-primary/90 text-white font-medium rounded-button !rounded-button whitespace-nowrap transition-all">
<span class="inline-flex items-center justify-center w-5 h-5 mr-2">
<i class="ri-send-plane-line"></i>
</span>
Publier mon commentaire
</button>
</div>
</form>
</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
const commentCards = document.querySelectorAll('.comment-card');
commentCards.forEach((card, index) => {
setTimeout(() => {
card.style.opacity = '1';
}, 100 * index);
});
});
</script>
</body>
</html>