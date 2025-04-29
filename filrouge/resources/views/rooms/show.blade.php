<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room - {{ $room->sujet }}</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fdfaff;
            background-image: url("https://readdy.ai/api/search-image?query=subtle%2520anime%2520pattern%2520background%2520with%2520light%2520purple%2520and%2520pink%2520colors%252C%2520very%2520faint%2520manga%2520style%2520elements%252C%2520minimal%2520design%252C%2520almost%2520invisible%2520pattern%252C%2520perfect%2520for%2520website%2520background%252C%2520not%2520distracting%252C%2520high%2520quality%2520digital%2520art&width=1920&height=1080&seq=bg123&orientation=landscape");
            background-attachment: fixed;
            background-size: cover;
        }

        .room-title {
            font-family: 'Bangers', cursive;
            letter-spacing: 1px;
        }

        .message-bubble {
            position: relative;
            border-radius: 18px;
            padding: 12px 16px;
            margin-bottom: 16px;
            max-width: 85%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .message-bubble.mine {
            background: linear-gradient(135deg, #8A2BE2 0%, #c0428a 100%);
            color: white;
            margin-left: auto;
            border-bottom-right-radius: 4px;
        }

        .message-bubble.others {
            background: white;
            border-bottom-left-radius: 4px;
            border-left: 3px solid #FF6B6B;
        }

        .message-bubble:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .timestamp {
            font-size: 0.7rem;
            opacity: 0.7;
        }

        .participant-badge {
            transition: all 0.3s ease;
        }

        .participant-badge:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(138, 43, 226, 0.2);
        }

        .send-button {
            background: linear-gradient(135deg, #FF6B6B 0%, #c0428a 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .send-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(192, 66, 138, 0.3);
        }

        .send-button:active {
            transform: translateY(1px);
        }

        .join-button {
            background: linear-gradient(135deg, #8A2BE2 0%, #47146E 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .join-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(138, 43, 226, 0.3);
        }

        .join-button:active {
            transform: translateY(1px);
        }

        .message-input {
            transition: all 0.3s ease;
            border: 2px solid rgba(138, 43, 226, 0.2);
        }

        .message-input:focus {
            border-color: #8A2BE2;
            box-shadow: 0 0 0 3px rgba(138, 43, 226, 0.1);
            outline: none;
        }

        .separator {
            height: 2px;
            background: linear-gradient(90deg, transparent, #F4C2C2, #FF6B6B, #F4C2C2, transparent);
        }


        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }
    </style>
</head>

<body>
@include('partials.header')

    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header
            class="bg-gradient-to-r from-[#8A2BE2] to-[#47146E] text-white py-6 px-4 md:px-8 relative overflow-hidden pt-20">
            <div class="header-decoration"></div>
            <div class="container mx-auto relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="room-title text-3xl md:text-4xl mb-2 text-white drop-shadow-lg">{{ $room->sujet }}
                        </h1>
                        <div class="flex items-center gap-2 text-[#F4C2C2]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-user-star-line"></i>
                            </div>
                            <p class="font-medium">Créée par <span class="font-bold">{{ $room->user->name }}</span></p>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center gap-3">

                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content -->
        <main class="flex-grow container mx-auto p-4 md:p-6 lg:p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Sidebar -->
                <div class="md:col-span-1">
                    <div class="mb-4">
                        <a href="{{ route('rooms.index') }}"
                            class="bg-gradient-to-r from-[#8A2BE2]/80 to-[#47146E]/80 hover:from-[#8A2BE2] hover:to-[#47146E] transition-all duration-300 py-3 px-6 text-white rounded-button font-medium flex items-center gap-2 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 w-full justify-center">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-arrow-left-line"></i>
                            </div>
                            <span>Retour aux Rooms</span>
                        </a>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gradient-to-r from-[#c0428a] to-[#FF6B6B] p-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <div class="w-6 h-6 flex items-center justify-center">
                                    <i class="ri-team-line"></i>
                                </div>
                                Participants
                            </h2>
                        </div>
                        <div class="p-4">
                            <div class="flex flex-wrap gap-2">
                                @foreach($room->participants as $participant)
                                    <div
                                        class="participant-badge flex items-center gap-2 bg-[#F4C2C2]/30 px-3 py-2 rounded-full">
                                        <div
                                            class="w-8 h-8 bg-[#8A2BE2] rounded-full flex items-center justify-center text-white">
                                            {{ substr($participant->user->name, 0, 1) }}
                                        </div>
                                        <span class="font-medium text-[#47146E]">{{ $participant->user->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                            @if(!$room->participants->contains('user_id', auth()->id()))
                                <div class="mt-6">
                                    <form method="POST" action="{{ route('rooms.join', $room) }}">
                                        @csrf
                                        <button type="submit"
                                            class="join-button w-full py-3 px-4 text-white rounded-button font-bold flex items-center justify-center gap-2 whitespace-nowrap">
                                            <div class="w-5 h-5 flex items-center justify-center">
                                                <i class="ri-login-circle-line"></i>
                                            </div>
                                            Rejoindre cette Room
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        <div class="p-4 border-t border-gray-100">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="font-bold text-[#47146E]">Thèmes populaires</h3>
                                <div class="w-6 h-6 flex items-center justify-center text-[#c0428a]">
                                    <i class="ri-fire-line"></i>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <span
                                    class="bg-[#F4C2C2]/40 px-3 py-1 rounded-full text-sm text-[#47146E]">Shonen</span>
                                <span
                                    class="bg-[#F4C2C2]/40 px-3 py-1 rounded-full text-sm text-[#47146E]">Seinen</span>
                                <span class="bg-[#F4C2C2]/40 px-3 py-1 rounded-full text-sm text-[#47146E]">Shojo</span>
                                <span
                                    class="bg-[#F4C2C2]/40 px-3 py-1 rounded-full text-sm text-[#47146E]">Isekai</span>
                                <span class="bg-[#F4C2C2]/40 px-3 py-1 rounded-full text-sm text-[#47146E]">Mecha</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Messages Area -->
                <div class="md:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden h-full flex flex-col">
                        <div class="bg-gradient-to-r from-[#8A2BE2] to-[#47146E] p-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <div class="w-6 h-6 flex items-center justify-center">
                                    <i class="ri-chat-3-line"></i>
                                </div>
                                Discussion
                            </h2>
                        </div>
                        <!-- Messages List -->
                        <div class="flex-grow p-4 overflow-y-auto" style="max-height: 500px;" id="message-container">
                            <ul id="message-list" class="space-y-2">
                                @forelse($messages as $message)
                                    <li class="fade-in">
                                        <div
                                            class="message-bubble {{ $message->user_id == auth()->id() ? 'mine' : 'others' }}">
                                            <div
                                                class="flex items-center gap-2 {{ $message->user_id == auth()->id() ? 'text-white/90' : 'text-[#8A2BE2]' }} mb-1">
                                                <div class="w-5 h-5 flex items-center justify-center">
                                                    <i class="ri-user-3-line"></i>
                                                </div>
                                                <strong>{{ $message->user->name }}</strong>
                                            </div>
                                            <p
                                                class="{{ $message->user_id == auth()->id() ? 'text-white' : 'text-gray-800' }}">
                                                {{ $message->message }}
                                            </p>
                                            <div class="flex items-center justify-between mt-2">
                                                @if($message->user_id == auth()->id())
                                                    <div class="flex items-center gap-3">
                                                        <button onclick="openEditModal({{ $message->id }})"
                                                            class="text-xs {{ $message->user_id == auth()->id() ? 'text-white/70' : 'text-gray-500' }} hover:underline flex items-center gap-1">
                                                            <i class="ri-edit-line"></i>
                                                            Modifier
                                                        </button>
                                                        <button type="button"
                                                            onclick="toggleModal('deleteMessageModal{{ $message->id }}')"
                                                            class="text-xs {{ $message->user_id == auth()->id() ? 'text-white/70' : 'text-gray-500' }} hover:underline flex items-center gap-1">
                                                            <i class="ri-delete-bin-line"></i>
                                                            Supprimer
                                                        </button>
                                                    </div>
                                                @endif
                                                <div
                                                    class="timestamp {{ $message->user_id == auth()->id() ? 'text-white/70' : 'text-gray-500' }}">
                                                    {{ $message->created_at->format('d/m/Y H:i') }}
                                                </div>
                                            </div>
                                            <div id="editMessageModal{{ $message->id }}"
                                                class="modal hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
                                                <div
                                                    class="modal-content bg-white p-6 rounded-xl shadow-lg w-11/12 md:w-2/3 lg:w-1/2 max-w-2xl transform transition-all">
                                                    <div class="flex justify-between items-center mb-4">
                                                        <h5 class="text-xl font-bold text-[#47146E]">Modifier le Message
                                                        </h5>
                                                        <button onclick="closeEditModal({{ $message->id }})"
                                                            class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
                                                            <i class="ri-close-line text-gray-500"></i>
                                                        </button>
                                                    </div>
                                                    <div class="separator mb-4"></div>
                                                    <form action="{{ route('messages.update', $message->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <textarea name="message"
                                                            class="message-input w-full p-4 rounded-xl resize-none focus:ring-0 bg-gray-50 mb-4"
                                                            rows="4">{{ $message->message }}</textarea>
                                                        <div class="flex justify-end gap-3">
                                                            <button type="button"
                                                                onclick="closeEditModal({{ $message->id }})"
                                                                class="px-4 py-2 rounded-button border border-gray-200 text-gray-700 hover:bg-gray-50 transition-all whitespace-nowrap">Annuler</button>
                                                            <button type="submit"
                                                                class="send-button px-4 py-2 text-white rounded-button font-medium whitespace-nowrap">Enregistrer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div id="deleteMessageModal{{ $message->id }}"
                                                class="modal hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
                                                <div
                                                    class="modal-content bg-white p-6 rounded-xl shadow-lg w-11/12 md:w-2/3 lg:w-1/2 max-w-lg transform transition-all">
                                                    <div class="flex justify-between items-center mb-4">
                                                        <h5 class="text-xl font-bold text-[#47146E]">Supprimer le Message
                                                        </h5>
                                                        <button
                                                            onclick="toggleModal('deleteMessageModal{{ $message->id }}')"
                                                            class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
                                                            <i class="ri-close-line text-gray-500"></i>
                                                        </button>
                                                    </div>
                                                    <div class="separator mb-4"></div>
                                                    <p class="text-gray-600 mb-6">Êtes-vous sûr de vouloir supprimer ce
                                                        message ?</p>
                                                    <div class="flex justify-end gap-3">
                                                        <button type="button"
                                                            onclick="toggleModal('deleteMessageModal{{ $message->id }}')"
                                                            class="px-4 py-2 rounded-button border border-gray-200 text-gray-700 hover:bg-gray-50 transition-all whitespace-nowrap">Annuler</button>
                                                        <form action="{{ route('messages.destroy', $message) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="bg-red-500 hover:bg-red-600 px-4 py-2 text-white rounded-button font-medium whitespace-nowrap">Supprimer</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="text-center py-8 text-gray-500">
                                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center text-[#F4C2C2]">
                                            <i class="ri-chat-smile-line ri-3x"></i>
                                        </div>
                                        <p>Aucun message pour le moment. Soyez le premier à écrire !</p>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                        <!-- Message Form -->
                        <div class="p-4 border-t border-gray-100">
                            <form action="{{ route('messages.store') }}" method="POST" class="flex flex-col gap-3">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $room->id }}">
                                <textarea name="message"
                                    class="message-input w-full p-4 rounded-xl resize-none focus:ring-0 border-none bg-gray-50"
                                    rows="3" placeholder="Partagez vos pensées sur l'anime ou le manga..."
                                    required></textarea>
                                <div class="flex justify-between items-center">
                                    <div class="flex gap-2">
                                        <button type="button"
                                            class="w-10 h-10 flex items-center justify-center bg-[#F4C2C2]/30 rounded-full text-[#c0428a]">
                                            <i class="ri-emotion-line ri-lg"></i>
                                        </button>
                                        <button type="button"
                                            class="w-10 h-10 flex items-center justify-center bg-[#F4C2C2]/30 rounded-full text-[#c0428a]">
                                            <i class="ri-image-line ri-lg"></i>
                                        </button>
                                    </div>
                                    <button type="submit"
                                        class="send-button py-3 px-6 text-white rounded-button font-bold flex items-center gap-2 whitespace-nowrap">
                                        <span>Envoyer</span>
                                        <div class="w-5 h-5 flex items-center justify-center">
                                            <i class="ri-send-plane-fill"></i>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer -->
        <footer class="mt-8 py-6 bg-[#47146E]/5">
            <div class="container mx-auto px-4">
                <div class="separator mb-6"></div>
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="text-center md:text-left">
                        <h3 class="text-xl font-['Pacifico'] text-[#8A2BE2]">蓮の花 Community</h3>
                        <p class="text-gray-600 text-sm mt-1">Le meilleur endroit pour discuter de vos séries préférées
                        </p>
                    </div>
                    <div class="flex gap-4">
                        <a href="#"
                            class="w-10 h-10 flex items-center justify-center bg-[#8A2BE2]/10 rounded-full text-[#8A2BE2] hover:bg-[#8A2BE2]/20 transition-all">
                            <i class="ri-discord-line ri-lg"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 flex items-center justify-center bg-[#8A2BE2]/10 rounded-full text-[#8A2BE2] hover:bg-[#8A2BE2]/20 transition-all">
                            <i class="ri-twitter-x-line ri-lg"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 flex items-center justify-center bg-[#8A2BE2]/10 rounded-full text-[#8A2BE2] hover:bg-[#8A2BE2]/20 transition-all">
                            <i class="ri-instagram-line ri-lg"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 flex items-center justify-center bg-[#8A2BE2]/10 rounded-full text-[#8A2BE2] hover:bg-[#8A2BE2]/20 transition-all">
                            <i class="ri-youtube-line ri-lg"></i>
                        </a>
                    </div>
                </div>
                <div class="text-center text-gray-500 text-xs mt-6">
                    © 2025 蓮の花 Community. Tous droits réservés.
                </div>
            </div>
        </footer>
    </div>
    <script>
        function openEditModal(messageId) {
            document.getElementById(`editMessageModal${messageId}`).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeEditModal(messageId) {
            document.getElementById(`editMessageModal${messageId}`).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }
        document.addEventListener('DOMContentLoaded', function () {
            const messageContainer = document.getElementById('message-container');
            if (messageContainer) {
                messageContainer.scrollTop = messageContainer.scrollHeight;
            }


            Pusher.logToConsole = true;

            const pusher = new Pusher('ab7edf357e81d712bd72', {
                cluster: 'mt1',
                encrypted: true,
                authEndpoint: '/broadcasting/auth'
            });

            const channel = pusher.subscribe('my-channel');

            channel.bind('chatEvent', (data) => {
                if (parseInt(data.user_id) === {{ auth()->id() }}) return;
                console.log(data);
                const messageList = document.getElementById('message-list');

                const newMessage = document.createElement('li');
                newMessage.classList.add('border-b', 'p-2');
                newMessage.innerHTML = `
                <li class="fade-in">
            <div
            class="message-bubble others">
            <div
                class="flex items-center gap-2 'text-[#8A2BE2]'  mb-1">
                <div class="w-5 h-5 flex items-center justify-center">
                    <i class="ri-user-3-line"></i>
                </div>
                <strong>${data.user}</strong>
            </div>
        <p
            class="text-gray-800 ">
            ${data.message}
        </p>
             <div
                class="timestamp text-gray-500">
                ${data.timestamp}
            </div>
            </li>
        `;

                messageList.appendChild(newMessage);

            });

        });
    </script>
</body>

</html>