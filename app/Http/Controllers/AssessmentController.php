<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Assessment;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Requests\AssessmentStoreRequest;
use App\Http\Requests\AssessmentUpdateRequest;

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
        $questions = Question::pluck('question_text', 'id');

        return view('app.assessments.create', compact('patients', 'questions'));
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

        // Loop through the submitted questions and answers
        foreach ($request->input('questions', []) as $key => $question) {
            // Ensure 'question_id' is set in each $question element
            $questionId = isset($question['question_id']) && is_numeric($question['question_id'])
                ? $question['question_id']
                : null;

            if (!is_null($questionId) && isset($question['answer_text'])) {
                // Create a new pivot record for each question and answer
                $assessment->questions()->attach($questionId, [
                    'answer_text' => $question['answer_text']
                ]);
            }
        }


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
        $questions = Question::pluck('question_text', 'id');

        // Get the old values of questions and answers
        $oldQuestions = $request->old('questions', $assessment->questions->toArray());

        return view('app.assessments.edit', compact('assessment', 'patients', 'questions', 'oldQuestions'));
    }

    /**
     * @param \App\Http\Requests\AssessmentUpdateRequest $request
     * @param \App\Models\Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function update(
        AssessmentUpdateRequest $request,
        Assessment $assessment
    ) {
        $this->authorize('update', $assessment);

        $validated = $request->validated();

        $assessment->update($validated);

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
