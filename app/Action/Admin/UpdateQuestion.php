<?php

namespace App\Action\Admin;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class UpdateQuestion
{
    public function updateQuestionAnsAnswers(string $questionID,
                                              array $validatedQuestionUpdateRequest): RedirectResponse
    {
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

}
