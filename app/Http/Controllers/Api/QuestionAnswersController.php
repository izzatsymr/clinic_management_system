<?php

namespace App\Http\Controllers\Api;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnswerResource;
use App\Http\Resources\AnswerCollection;

class QuestionAnswersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Question $question)
    {
        $this->authorize('view', $question);

        $search = $request->get('search', '');

        $answers = $question
            ->answers()
            ->search($search)
            ->latest()
            ->paginate();

        return new AnswerCollection($answers);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Question $question)
    {
        $this->authorize('create', Answer::class);

        $validated = $request->validate([
            'answer_text' => ['required', 'max:255', 'string'],
        ]);

        $answer = $question->answers()->create($validated);

        return new AnswerResource($answer);
    }
}
