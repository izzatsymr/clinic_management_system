<?php

namespace App\Http\Controllers\Api;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionCollection;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Requests\QuestionUpdateRequest;

class QuestionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Question::class);

        $search = $request->get('search', '');

        $questions = Question::search($search)
            ->latest()
            ->paginate();

        return new QuestionCollection($questions);
    }

    /**
     * @param \App\Http\Requests\QuestionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionStoreRequest $request)
    {
        $this->authorize('create', Question::class);

        $validated = $request->validated();

        $question = Question::create($validated);

        return new QuestionResource($question);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Question $question)
    {
        $this->authorize('view', $question);

        return new QuestionResource($question);
    }

    /**
     * @param \App\Http\Requests\QuestionUpdateRequest $request
     * @param \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request, Question $question)
    {
        $this->authorize('update', $question);

        $validated = $request->validated();

        $question->update($validated);

        return new QuestionResource($question);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Question $question)
    {
        $this->authorize('delete', $question);

        $question->delete();

        return response()->noContent();
    }
}
