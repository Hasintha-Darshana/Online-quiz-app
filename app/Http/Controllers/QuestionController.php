<?php

namespace App\Http\Controllers;

use App\Action\Admin\CreateQuestion;
use App\Action\Admin\GetQuestionDetailsForQuestionUpdate;
use App\Action\Admin\UpdateQuestion;
use App\Models\Answer;
use App\Models\Question;
use App\Service\GetQuestion;
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
    public function editQuestion(
        string $questionId,
        GetQuestionDetailsForQuestionUpdate $getQuestionDetailsForQuestionUpdate
    ): View|Factory|Application|RedirectResponse
    {
        if ($questionId) {
            return $getQuestionDetailsForQuestionUpdate->getQuestionAndRelatedAnswersForUpdate($questionId);
        }

        return redirect()->route('dashboard')->with('warning', 'validation error have');
    }

    public function updateQuestion(
        string $questionId,
        QuestionCreateRequest $request,
        UpdateQuestion $updateQuestion
    ): RedirectResponse {
        $validatedQuestionUpdateRequest = $request->validated();

        if ($validatedQuestionUpdateRequest) {
            $updateQuestion->updateQuestionAnsAnswers($questionId, $validatedQuestionUpdateRequest);
        }

        return redirect()->route('dashboard')->with('warning', 'validation error have');
    }

    public function deleteQuestion(string $questionId)
    {
        $question = GetQuestion::getQuestionByQuestionId();
        $question->delete();

        return redirect()->route('dashboard')->with('success', 'Question has been deleted');
    }
}
