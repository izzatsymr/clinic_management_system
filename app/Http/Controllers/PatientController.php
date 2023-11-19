<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.patients.index', compact('patients', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Patient::class);

        return view('app.patients.create');
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

        // Redirect to the assessment create page with the patient ID
        return redirect()
            ->route('assessments.create', ['patient_id' => $patient->id])
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Patient $patient)
    {
        $this->authorize('view', $patient);

        return view('app.patients.show', compact('patient'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Patient $patient)
    {
        $this->authorize('update', $patient);

        return view('app.patients.edit', compact('patient'));
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

        return redirect()
            ->route('patients.edit', $patient)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('patients.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
