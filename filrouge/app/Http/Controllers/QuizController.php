<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Content;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index(Content $content)
    {
        $quiz = $content->quiz;
        return view('quizzes.index', compact( 'quiz','content'));
    }

    public function store(Request $request, Content $content)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'required|image|max:2048',
        ]);

        $image = $request->file('photo');
        $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('quiz'), $imageName);

        $content->quiz()->create([
            'user_id' => Auth::id(),
            'titre' => $request->titre,
            'description' => $request->description,
            'photo' => 'quiz/' . $imageName,
        ]);

        return redirect()->route('content.quiz.index', $content)->with('success', 'Quiz créé avec succès.');
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['titre', 'description']);

        if ($request->hasFile('photo')) {
            $oldImagePath = public_path($quiz->photo);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $image = $request->file('photo');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('quiz'), $imageName);
            $data['photo'] = 'quiz/' . $imageName;
        }

        $quiz->update($data);

        return redirect()->route('content.quiz.index', $quiz->content)->with('success', 'Quiz modifié avec succès.');
    }

    public function destroy(Quiz $quiz)
    {
        $imagePath = public_path($quiz->photo);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $quiz->delete();

        return redirect()->route('content.quiz.index', $quiz->content)->with('success', 'Quiz supprimé.');
    }

}
