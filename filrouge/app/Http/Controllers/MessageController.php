<?php

namespace App\Http\Controllers;

use App\Events\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
public function store(Request $request)
{
    $request->validate([
        'room_id' => 'required|exists:rooms,id',
        'message' => 'required|string|max:500',
    ]);
    $message = Message::create([
        'user_id' => auth()->id(),
        'room_id' => $request->room_id,
        'message' => $request->message,
    ]);
    broadcast(new Chat([
        'message' => $message->message,
        'user' => $message->user->name, 
        'room_id' => $message->room_id,
        'user_id' => $message->user->id,
        'timestamp' => $message->created_at->toDateTimeString(),
    ]));
    // return response(null, 200);
    return redirect()->back()->with('success', 'Message envoyé.');

}

    public function update(Request $request, Message $message)
{
    if ($message->user_id !== auth()->id()) {
        return redirect()->back()->with('error', 'Vous ne pouvez pas modifier ce message.');
    }

    $request->validate([
        'message' => 'required|string|max:500',
    ]);

    $message->update([
        'message' => $request->message,
    ]);

    return redirect()->back()->with('success', 'Message modifié avec succès.');
}

public function destroy(Message $message)
{
    if ($message->user_id !== auth()->id()) {
        return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer ce message.');
    }
    $message->delete();
    return redirect()->back()->with('success', 'Message supprimé avec succès.');
}




}
