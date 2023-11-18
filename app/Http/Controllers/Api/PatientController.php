<?php

namespace App\Http\Controllers\Api;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use App\Http\Resources\PatientCollection;
use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\PatientUpdateRequest;

class PatientController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Patient::class);

        $search = $request->get('search', '');

        $patients = Patient::search($search)
            ->latest()
            ->paginate();

        return new PatientCollection($patients);
    }

    /**
     * @param \App\Http\Requests\PatientStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientStoreRequest $request)
    {
        $this->authorize('create', Patient::class);

        $validated = $request->validated();

        $patient = Patient::create($validated);

        return new PatientResource($patient);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Patient $patient)
    {
        $this->authorize('view', $patient);

        return new PatientResource($patient);
    }

    /**
     * @param \App\Http\Requests\PatientUpdateRequest $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function update(PatientUpdateRequest $request, Patient $patient)
    {
        $this->authorize('update', $patient);

        $validated = $request->validated();

        $patient->update($validated);

        return new PatientResource($patient);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Patient $patient)
    {
        $this->authorize('delete', $patient);

        $patient->delete();

        return response()->noContent();
    }
}
