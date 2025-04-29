@include('partials.header')

    <h1>Liste des Rooms</h1>

    <form method="POST" action="{{ route('rooms.store') }}">
        @csrf
        <label for="sujet">Sujet:</label>
        <input type="text" name="sujet" id="sujet" required>

        <button type="submit">Créer la Room</button>
    </form>

    <hr>
    <ul>
        @foreach($rooms as $room)
            <li>
                {{ $room->sujet }} 
                <a href="{{ route('rooms.show', $room) }}">Voir</a>
                @if($room->user_id === auth()->id())
                | <button type="button" data-toggle="modal" data-target="#editRoomModal{{ $room->id }}">Modifier</button>

                <!-- Formulaire de suppression -->
                <form action="{{ route('rooms.destroy', $room) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Es-tu sûr de vouloir supprimer cette room ?')">Supprimer</button>
                </form>

                <!-- Modal de modification -->
                <div id="editRoomModal{{ $room->id }}" class="modal" style="display:none;">
                    <div class="modal-content" style="background: #fff; padding:20px; border-radius:8px;">
                        <span class="close" onclick="document.getElementById('editRoomModal{{ $room->id }}').style.display='none'" style="cursor:pointer; float:right;">&times;</span>

                        <h2>Modifier la Room</h2>

                        <form method="POST" action="{{ route('rooms.update', $room) }}">
                            @csrf
                            @method('PUT')

                            <label for="sujet">Sujet:</label>
                            <input type="text" name="sujet" id="sujet" value="{{ old('sujet', $room->sujet) }}" required>

                            <button type="submit">Mettre à jour</button>
                        </form>
                    </div>
                </div>

                <script>
                    document.querySelector('[data-toggle="modal"][data-target="#editRoomModal{{ $room->id }}"]').onclick = function() {
                        document.getElementById('editRoomModal{{ $room->id }}').style.display = 'block';
                    };
                </script>
            @endif
            </li>
        @endforeach
    </ul>
