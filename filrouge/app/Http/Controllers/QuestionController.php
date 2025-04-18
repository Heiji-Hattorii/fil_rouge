<?php
namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request, Quiz $quiz)
    {
        $request->validate([
            'question' => 'required|string',
            'reponses' => 'required|string',
            'reponseCorrecte' => 'required|string',
        ]);

        $quiz->questions()->create([
            'question' => $request->question,
            'reponses' => $request->reponses,
            'reponseCorrecte' => $request->reponseCorrecte,
            'quiz_id' => $quiz->id,
        ]);

        return redirect()->route('content.quiz.index', $quiz->content)->with('success', 'Question ajoutée avec succès');
    }

    public function update(Request $request, Quiz $quiz, Question $question)
    {
        $request->validate([
            'question' => 'required|string',
            'reponses' => 'required|string',
            'reponseCorrecte' => 'required|string',
        ]);

        $question->update([
            'question' => $request->question,
            'reponses' => $request->reponses,
            'reponseCorrecte' => $request->reponseCorrecte,
        ]);

        return redirect()->route('content.quiz.index', $quiz->content)->with('success', 'Question modifiée avec succès');
    }

    public function destroy(Quiz $quiz, Question $question)
    {
        $question->delete();
        return redirect()->route('content.quiz.index', $quiz->content)->with('success', 'Question supprimée avec succès');
    }
    
}
