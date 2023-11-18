<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.answers.index', compact('answers', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Answer::class);

        $questions = Question::pluck('question_text', 'id');

        return view('app.answers.create', compact('questions'));
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

        return redirect()
            ->route('answers.edit', $answer)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Answer $answer)
    {
        $this->authorize('view', $answer);

        return view('app.answers.show', compact('answer'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Answer $answer)
    {
        $this->authorize('update', $answer);

        $questions = Question::pluck('question_text', 'id');

        return view('app.answers.edit', compact('answer', 'questions'));
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

        return redirect()
            ->route('answers.edit', $answer)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('answers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
