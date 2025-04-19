<title>Room - {{ $room->sujet }}</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold">Room: {{ $room->sujet }}</h1>
    <p>Créée par : {{ $room->user->name }}</p>

    <h2 class="text-xl mt-4">Participants:</h2>
    <ul>
        @foreach($room->participants as $participant)
            <li>{{ $participant->user->name }}</li>
        @endforeach
    </ul>

    @if(!$room->participants->contains('user_id', auth()->id()))
        <form method="POST" action="{{ route('rooms.join', $room) }}">
            @csrf
            <button type="submit" class="mt-2 p-2 bg-blue-500 text-white rounded">Rejoindre cette Room</button>
        </form>
    @endif

    <form action="{{ route('messages.store') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id }}">
        <textarea name="message" class="w-full p-2 border rounded" placeholder="Votre message..." required></textarea>
        <button type="submit" class="mt-2 p-2 bg-green-500 text-white rounded">Envoyer</button>
    </form>

    <hr class="my-4">

    <h2 class="text-xl">Messages</h2>
    <ul id="message-list">
        @forelse($messages as $message)
            <li class="border-b p-2">
                <strong>{{ $message->user->name }}</strong> :
                <p>{{ $message->message }}</p>
                <small>{{ $message->created_at->format('d/m/Y H:i') }}</small>

                @if($message->user_id == auth()->id())
                    <button type="button" onclick="toggleModal('editMessageModal{{ $message->id }}')"
                        class="mt-2 p-2 bg-yellow-500 text-white rounded">Modifier</button>
                    <div id="editMessageModal{{ $message->id }}"
                        class="modal hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
                        <div class="modal-content bg-white p-4 rounded shadow-lg w-1/2">
                            <h5 class="text-xl">Modifier le Message</h5>
                            <form action="{{ route('messages.update', $message) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <textarea name="message" class="w-full p-2 border rounded"
                                    required>{{ $message->message }}</textarea>
                                <div class="mt-4 flex justify-end">
                                    <button type="button" class="btn-cancel p-2 bg-gray-500 text-white rounded"
                                        onclick="toggleModal('editMessageModal{{ $message->id }}')">Fermer</button>
                                    <button type="submit" class="btn-submit p-2 bg-blue-500 text-white rounded ml-2">Mettre à
                                        jour</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <button type="button" onclick="toggleModal('deleteMessageModal{{ $message->id }}')"
                        class="mt-2 p-2 bg-red-500 text-white rounded">Supprimer</button>
                    <div id="deleteMessageModal{{ $message->id }}"
                        class="modal hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
                        <div class="modal-content bg-white p-4 rounded shadow-lg w-1/2">
                            <h5 class="text-xl">Supprimer le Message</h5>
                            <p>Êtes-vous sûr de vouloir supprimer ce message ?</p>
                            <div class="mt-4 flex justify-end">
                                <button type="button" class="btn-cancel p-2 bg-gray-500 text-white rounded"
                                    onclick="toggleModal('deleteMessageModal{{ $message->id }}')">Annuler</button>
                                <form action="{{ route('messages.destroy', $message) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE') <!-- C'est ici la modification à apporter -->
                                    <button type="submit" class="p-2 bg-red-500 text-white rounded ml-2">Supprimer</button>
                                </form>

                            </div>
                        </div>
                    </div>
                @endif
            </li>
        @empty
            <li>Aucun message pour l'instant.</li>
        @endforelse
    </ul>

    <a href="{{ route('rooms.index') }}" class="mt-4 p-2 bg-gray-500 text-white rounded">Retour aux Rooms</a>
</div>

<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.toggle('hidden');
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
                <strong>${data.user}</strong> :
                <p>${data.message}</p>
                <small>${data.timestamp}</small>
            `;

            messageList.appendChild(newMessage); 
        
    });



</script>
</body>

</html>