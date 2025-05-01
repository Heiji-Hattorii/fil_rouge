<?php
namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;

class MembreController extends Controller
{
    public function addLike($id)
    {
        $user = Auth::user();

        if (!$user->likes()->where('content_id', $id)->exists()) {
            $user->likes()->create([
                'content_id' => $id,
            ]);
        }

        return back();
    }

    public function removeLike($id)
    {
        $user = Auth::user();

        $user->likes()->where('content_id', $id)->delete();

        return back();
    }
}
