<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Assessment;
use Illuminate\Http\Request;
use App\Http\Requests\AssessmentStoreRequest;
use App\Http\Requests\AssessmentUpdateRequest;

use App\Models\Question;
use App\Models\Answer;

class AssessmentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Assessment::class);

        $search = $request->get('search', '');

        $assessments = Assessment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.assessments.index', compact('assessments', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Assessment::class);

        $patients = Patient::pluck('name', 'id');

        return view('app.assessments.create', compact('patients'));
    }

    /**
     * @param \App\Http\Requests\AssessmentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssessmentStoreRequest $request)
    {
        $this->authorize('create', Assessment::class);

        $validated = $request->validated();

        // Create the assessment
        $assessment = Assessment::create($validated);

        // Create a question associated with the assessment
        $question = Question::create([
            'question_text' => $request->input('question_text'), // Assuming you have a question_text input in your form
            'assessment_id' => $assessment->id,
        ]);

        // Create an answer associated with the question
        $answer = Answer::create([
            'answer_text' => $request->input('answer_text'), // Assuming you have an answer_text input in your form
            'question_id' => $question->id,
        ]);

        return redirect()
            ->route('assessments.edit', $assessment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Assessment $assessment)
    {
        $this->authorize('view', $assessment);

        return view('app.assessments.show', compact('assessment'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Assessment $assessment)
    {
        $this->authorize('update', $assessment);

        $patients = Patient::pluck('name', 'id');

        return view('app.assessments.edit', compact('assessment', 'patients'));
    }

    /**
     * @param \App\Http\Requests\AssessmentUpdateRequest $request
     * @param \App\Models\Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function update(AssessmentUpdateRequest $request, Assessment $assessment)
    {
        $this->authorize('update', $assessment);

        $validated = $request->validated();

        // Update the assessment
        $assessment->update($validated);

        // Update the associated question
        $assessment->questions->first()->update([
            'question_text' => $request->input('question_text'), // Assuming you have a question_text input in your form
        ]);

        // Update the associated answer
        $assessment->questions->first()->answers->first()->update([
            'answer_text' => $request->input('answer_text'), // Assuming you have an answer_text input in your form
        ]);

        return redirect()
            ->route('assessments.edit', $assessment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Assessment $assessment)
    {
        $this->authorize('delete', $assessment);

        $assessment->delete();

        return redirect()
            ->route('assessments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
