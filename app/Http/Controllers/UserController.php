<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\UserAnswer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUserDashboard(Request $request): View|Factory|Application
    {
        $user = $request->user();
       //$questions= Question::with('answers')->get();

        $unAnswersQuestions = Question::whereDoesntHave('userAnswers', function (Builder $query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        $totalQuestionCount = Question::count();

        $correctAnswersCount = UserAnswer::where('user_id', $user->id)
            ->where('is_correct', true)
            ->count();




        return view('user.dashboard')->with([
            'questions' => $unAnswersQuestions,
            'totalQuestionCount' => $totalQuestionCount,
            'correctAnswersCount' => $correctAnswersCount,
        ]);
    }

    public function answerForQuestion(string $questionId, Request $request): \Illuminate\Http\RedirectResponse
    {
        $validatedAnswer = $request->validate([
            'answer' => ['required','string']
        ]);

        $question = Question::findOrFail($questionId);
        $user = $request->user();

        $iscorrectAnswer =trim($validatedAnswer['answer'] )=== trim($question->correct_answer) ;

        UserAnswer::create([
            'user_id' => $user->id,
            'question_id' => $question->id,
            'answer' => $validatedAnswer['answer'],
            'is_correct' => $iscorrectAnswer
        ]);

        $message = $iscorrectAnswer ? 'Your answer is correct' : 'Your answer is incorrect';

        return redirect()->route('user-dashboard')->with('message', $message);

    }
}
