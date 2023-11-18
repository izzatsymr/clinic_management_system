<?php
namespace App\Http\Controllers\Api;

use App\Models\Question;
use App\Models\Assessment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssessmentCollection;

class QuestionAssessmentsController extends Controller
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

        $assessments = $question
            ->assessments()
            ->search($search)
            ->latest()
            ->paginate();

        return new AssessmentCollection($assessments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Question $question
     * @param \App\Models\Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        Question $question,
        Assessment $assessment
    ) {
        $this->authorize('update', $question);

        $question->assessments()->syncWithoutDetaching([$assessment->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Question $question
     * @param \App\Models\Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        Question $question,
        Assessment $assessment
    ) {
        $this->authorize('update', $question);

        $question->assessments()->detach($assessment);

        return response()->noContent();
    }
}
