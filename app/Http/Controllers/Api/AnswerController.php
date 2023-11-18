<?php

namespace App\Http\Controllers\Api;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnswerResource;
use App\Http\Resources\AnswerCollection;
use App\Http\Requests\AnswerStoreRequest;
use App\Http\Requests\AnswerUpdateRequest;

class AnswerController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Answer::class);

        $search = $request->get('search', '');

        $answers = Answer::search($search)
            ->latest()
            ->paginate();

        return new AnswerCollection($answers);
    }

    /**
     * @param \App\Http\Requests\AnswerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerStoreRequest $request)
    {
        $this->authorize('create', Answer::class);

        $validated = $request->validated();

        $answer = Answer::create($validated);

        return new AnswerResource($answer);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Answer $answer)
    {
        $this->authorize('view', $answer);

        return new AnswerResource($answer);
    }

    /**
     * @param \App\Http\Requests\AnswerUpdateRequest $request
     * @param \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function update(AnswerUpdateRequest $request, Answer $answer)
    {
        $this->authorize('update', $answer);

        $validated = $request->validated();

        $answer->update($validated);

        return new AnswerResource($answer);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Answer $answer)
    {
        $this->authorize('delete', $answer);

        $answer->delete();

        return response()->noContent();
    }
}
