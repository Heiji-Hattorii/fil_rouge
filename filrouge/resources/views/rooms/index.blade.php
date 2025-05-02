<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Rooms</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>

    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 50;
        }
        input[type="text"]:focus {
            outline: none;
            border-color: #4F46E5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }
        }
    </style>
</head>
<body>
@include('partials.header')
    <div class="min-h-screen flex flex-col">

        <main class="flex-1 container mx-auto pt-20 px-4 py-8">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white shadow rounded-lg p-6 mb-8">
                    <h2 class="text-xl font-semibold mb-6 text-gray-800">Créer une nouvelle Room</h2>
                    <form method="POST" action="{{ route('rooms.store') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label for="sujet" class="block text-sm font-medium text-gray-700 mb-1">Sujet:</label>
                            <input type="text" name="sujet" id="sujet" required class="w-full px-4 py-2 border border-gray-300 rounded-button focus:ring-2 focus:ring-violet-600/20 transition-all duration-200">
                        </div>
                        <div>
                            <button type="submit" class="px-4 py-2 bg-violet-600 text-white rounded-button hover:bg-violet-600/90 transition-colors !rounded-button whitespace-nowrap flex items-center">
                                <i class="ri-add-line mr-2"></i>
                                Créer la Room
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-6 text-gray-800">Mes Rooms</h2>
                    <ul class="divide-y divide-gray-200">
                        @foreach($rooms as $room)
                            <li class="py-4 first:pt-0 last:pb-0">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-medium text-gray-800">{{ $room->sujet }}</h3>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('rooms.show', $room) }}" class="inline-flex items-center px-3 py-1.5 text-sm text-violet-600 bg-violet-600/10 rounded-button hover:bg-violet-600/20 transition-colors !rounded-button whitespace-nowrap">
                                            <i class="ri-eye-line mr-1"></i>
                                            Voir
                                        </a>
                                        @if($room->user_id === auth()->id())
                                            <button type="button" data-toggle="modal" data-target="#editRoomModal{{ $room->id }}" onclick="document.getElementById('editRoomModal{{ $room->id }}').style.display='flex'" class="inline-flex items-center px-3 py-1.5 text-sm text-blue-600 bg-blue-50 rounded-button hover:bg-blue-100 transition-colors !rounded-button whitespace-nowrap">
                                                <i class="ri-edit-line mr-1"></i>
                                                Modifier
                                            </button>
                                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Es-tu sûr de vouloir supprimer cette room ?')" class="inline-flex items-center px-3 py-1.5 text-sm text-red-600 bg-red-50 rounded-button hover:bg-red-100 transition-colors !rounded-button whitespace-nowrap">
                                                    <i class="ri-delete-bin-line mr-1"></i>
                                                    Supprimer
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach                       
                    </ul>
                </div>
            </div>
        </main>

    </div>
    @foreach($rooms as $room)
        <div id="editRoomModal{{ $room->id }}" class="modal" style="display:none;">
            <div class="modal-content bg-white rounded-lg shadow-xl max-w-md w-full p-6 m-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Modifier la Room</h2>
                    <button type="button" onclick="document.getElementById('editRoomModal{{ $room->id }}').style.display='none'" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
                            <i class="ri-close-line text-xl"></i>
                        </span>
                    </button>
                </div>
                <form method="POST" action="{{ route('rooms.update', $room) }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="sujet" class="block text-sm font-medium text-gray-700 mb-1">Sujet:</label>
                        <input type="text" name="sujet" id="sujet" value="{{ old('sujet', $room->sujet) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-button focus:ring-2 focus:ring-violet-600/20 transition-all duration-200">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="document.getElementById('editRoomModal{{ $room->id }}').style.display='none'" class="mr-2 px-4 py-2 border border-gray-300 text-gray-700 rounded-button hover:bg-gray-50 transition-colors !rounded-button whitespace-nowrap">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-violet-600 text-white rounded-button hover:bg-violet-600/90 transition-colors !rounded-button whitespace-nowrap">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <div id="editRoomModal1" class="modal" style="display:none;">
        <div class="modal-content bg-white rounded-lg shadow-xl max-w-md w-full p-6 m-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Modifier la Room</h2>
                <button type="button" onclick="document.getElementById('editRoomModal1').style.display='none'" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
                        <i class="ri-close-line text-xl"></i>
                    </span>
                </button>
            </div>
            <form method="POST" action="#" class="space-y-4">
                <div>
                    <label for="sujet1" class="block text-sm font-medium text-gray-700 mb-1">Sujet:</label>
                    <input type="text" name="sujet" id="sujet1" value="Discussion sur l'art contemporain" required class="w-full px-4 py-2 border border-gray-300 rounded-button focus:ring-2 focus:ring-violet-600/20 transition-all duration-200">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="document.getElementById('editRoomModal1').style.display='none'" class="mr-2 px-4 py-2 border border-gray-300 text-gray-700 rounded-button hover:bg-gray-50 transition-colors !rounded-button whitespace-nowrap">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-violet-600 text-white rounded-button hover:bg-violet-600/90 transition-colors !rounded-button whitespace-nowrap">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="editRoomModal2" class="modal" style="display:none;">
        <div class="modal-content bg-white rounded-lg shadow-xl max-w-md w-full p-6 m-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Modifier la Room</h2>
                <button type="button" onclick="document.getElementById('editRoomModal2').style.display='none'" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
                        <i class="ri-close-line text-xl"></i>
                    </span>
                </button>
            </div>
            <form method="POST" action="#" class="space-y-4">
                <div>
                    <label for="sujet2" class="block text-sm font-medium text-gray-700 mb-1">Sujet:</label>
                    <input type="text" name="sujet" id="sujet2" value="Débat philosophique" required class="w-full px-4 py-2 border border-gray-300 rounded-button focus:ring-2 focus:ring-violet-600/20 transition-all duration-200">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="document.getElementById('editRoomModal2').style.display='none'" class="mr-2 px-4 py-2 border border-gray-300 text-gray-700 rounded-button hover:bg-gray-50 transition-colors !rounded-button whitespace-nowrap">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-violet-600 text-white rounded-button hover:bg-violet-600/90 transition-colors !rounded-button whitespace-nowrap">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="editRoomModal3" class="modal" style="display:none;">
        <div class="modal-content bg-white rounded-lg shadow-xl max-w-md w-full p-6 m-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Modifier la Room</h2>
                <button type="button" onclick="document.getElementById('editRoomModal3').style.display='none'" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
                        <i class="ri-close-line text-xl"></i>
                    </span>
                </button>
            </div>
            <form method="POST" action="#" class="space-y-4">
                <div>
                    <label for="sujet3" class="block text-sm font-medium text-gray-700 mb-1">Sujet:</label>
                    <input type="text" name="sujet" id="sujet3" value="Échange linguistique français-anglais" required class="w-full px-4 py-2 border border-gray-300 rounded-button focus:ring-2 focus:ring-violet-600/20 transition-all duration-200">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="document.getElementById('editRoomModal3').style.display='none'" class="mr-2 px-4 py-2 border border-gray-300 text-gray-700 rounded-button hover:bg-gray-50 transition-colors !rounded-button whitespace-nowrap">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-violet-600 text-white rounded-button hover:bg-violet-600/90 transition-colors !rounded-button whitespace-nowrap">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fermer les modals quand on clique en dehors
            window.onclick = function(event) {
                const modals = document.getElementsByClassName('modal');
                for (let i = 0; i < modals.length; i++) {
                    if (event.target == modals[i]) {
                        modals[i].style.display = "none";
                    }
                }
            }
        });
    </script>
</body>
</html>