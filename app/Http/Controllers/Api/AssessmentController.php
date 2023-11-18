<?php

namespace App\Http\Controllers\Api;

use App\Models\Assessment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssessmentResource;
use App\Http\Resources\AssessmentCollection;
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
            ->paginate();

        return new AssessmentCollection($assessments);
    }

    /**
     * @param \App\Http\Requests\AssessmentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssessmentStoreRequest $request)
    {
        $this->authorize('create', Assessment::class);

        $validated = $request->validated();

        $assessment = Assessment::create($validated);

        return new AssessmentResource($assessment);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Assessment $assessment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Assessment $assessment)
    {
        $this->authorize('view', $assessment);

        return new AssessmentResource($assessment);
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

        return new AssessmentResource($assessment);
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

        return response()->noContent();
    }
}
