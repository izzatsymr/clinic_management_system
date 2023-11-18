<?php

namespace App\Http\Controllers\Api;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\AppointmentCollection;

class PatientAppointmentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Patient $patient)
    {
        $this->authorize('view', $patient);

        $search = $request->get('search', '');

        $appointments = $patient
            ->appointments()
            ->search($search)
            ->latest()
            ->paginate();

        return new AppointmentCollection($appointments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {
        $this->authorize('create', Appointment::class);

        $validated = $request->validate([
            'date_time' => ['required', 'date'],
            'status' => ['required', 'in:scheduled,completed,cancelled'],
            'note' => ['required', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $appointment = $patient->appointments()->create($validated);

        return new AppointmentResource($appointment);
    }
}
