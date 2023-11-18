<?php

namespace App\Http\Controllers\Api;

use App\Models\Assessment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionCollection;

class AssessmentQuestionsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Assessment $assessment)
    {
        $this->authorize('view', $assessment);

        $search = $request->get('search', '');

        $questions = $assessment
            ->questions()
            ->search($search)
            ->latest()
            ->paginate();

        return new QuestionCollection($questions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Assessment $assessment)
    {
        $this->authorize('create', Question::class);

        $validated = $request->validate([
            'question_text' => ['required', 'max:255', 'string'],
        ]);

        $question = $assessment->questions()->create($validated);

        return new QuestionResource($question);
    }
}
