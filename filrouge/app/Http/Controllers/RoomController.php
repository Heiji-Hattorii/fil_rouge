<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }


public function store(Request $request)
{
    $request->validate([
        'sujet' => 'required|string|max:255',
    ]);

    $room = Room::create([
        'user_id' => auth()->id(),
        'sujet' => $request->sujet,
        'token' => Str::random(10),
    ]);

    Participant::create([
        'room_id' => $room->id,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('rooms.index')->with('success', 'Room créée avec succès!');
}


public function show(Room $room)
{
    $messages = Message::where('room_id', $room->id)
                        ->with('user') // Charger l'utilisateur qui a envoyé le message
                        ->orderBy('created_at', 'asc') // Optionnel : messages du plus ancien au plus récent
                        ->get();

    return view('rooms.show', [
        'room' => $room,
        'messages' => $messages,
    ]);
}

    public function join(Room $room)
    {
        Participant::firstOrCreate([
            'room_id' => $room->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('rooms.show', $room)->with('success', 'Vous avez rejoint la Room.');
    }

    public function update(Request $request, Room $room)
{
    if ($room->user_id !== auth()->id()) {
        abort(403, 'Vous n\'êtes pas autorisé à modifier cette room.');
    }

    $request->validate([
        'sujet' => 'required|string|max:255',
    ]);
    $room->update([
        'sujet' => $request->sujet,
    ]);
    return redirect()->route('rooms.index')->with('success', 'Room mise à jour avec succès.');
}
public function destroy(Room $room)
{
    if ($room->user_id !== auth()->id()) {
        abort(403, 'Vous n\'êtes pas autorisé à supprimer cette room.');
    }
    $room->delete();
    return redirect()->route('rooms.index')->with('success', 'Room supprimée avec succès.');
}


}
