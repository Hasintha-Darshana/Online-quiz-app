<?php

namespace App\Http\Controllers;

use App\Action\Admin\CreateQuestion;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Http\Requests\QuestionCreateRequest;

class QuestionController extends Controller
{
    public function createQuestion(): View|Factory|Application
    {
        return view('admin.questions.create-question');
    }

    public function addQuestion(QuestionCreateRequest $request , CreateQuestion $createQuestion): RedirectResponse
    {
        $validatedQuestionCreateRequest = $request->validated();

        if($validatedQuestionCreateRequest){
            $createQuestion->createQuestionAndAnswers($validatedQuestionCreateRequest);
        }

        return redirect()->route('dashboard')->with('warning' ,'Validation error');
    }

    /**
     * @param Request $request
     *
     * @return void
     */
    public function editQuestion(string $questionId)
    {
        $question = Question::with('answers')->findOrFail($questionId);

        $answer1 = $question->answers[0]->answer;
        $answer2 = $question->answers[1]->answer;
        $answer3 = $question->answers[2]->answer;
        $answer4 = $question->answers[3]->answer;

        $sendToBlade = [
            'question' => $question,
            'correct_answer' => $question->correct_answer,
            'answer1' => $answer1,
            'answer2' => $answer2,
            'answer3' => $answer3,
            'answer4' => $answer4,

        ];

        return view('admin.questions.update')->with($sendToBlade);
    }

    public function updateQuestion(string $questionID, QuestionCreateRequest $request)
    {
        $validatedQuestionUpdateRequest = $request->validated();

        $question = Question::findOrFail($questionID);

        DB::transaction(function () use ($question, $validatedQuestionUpdateRequest) {
            $question->update([
                'question' =>   $validatedQuestionUpdateRequest['question'],
                'correct_answer' =>   $validatedQuestionUpdateRequest['correct'],
            ]);

            $answers = [
                'answer1' =>   $validatedQuestionUpdateRequest['answer1'],
                'answer2' =>   $validatedQuestionUpdateRequest['answer2'],
                'answer3' =>   $validatedQuestionUpdateRequest['answer3'],
                'answer4' =>   $validatedQuestionUpdateRequest['answer4'],

            ];

            foreach ($question->answers as $index=>$answer) {
                $answer->update([
                    'answer' =>$answers['answer'.($index + 1)],
                ]);
            }
        });

        return redirect()->route('dashboard');
    }

    public function deleteQuestion(string $questionId)
    {
        $question = Question::findOrFail($questionId);
        $question->delete();

        return redirect()->route('dashboard')->with('success', 'Question has been deleted');
    }
}
