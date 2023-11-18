<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\AppointmentCollection;

class UserAppointmentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $appointments = $user
            ->appointments()
            ->search($search)
            ->latest()
            ->paginate();

        return new AppointmentCollection($appointments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Appointment::class);

        $validated = $request->validate([
            'date_time' => ['required', 'date'],
            'status' => ['required', 'in:scheduled,completed,cancelled'],
            'note' => ['required', 'max:255', 'string'],
            'patient_id' => ['required', 'exists:patients,id'],
        ]);

        $appointment = $user->appointments()->create($validated);

        return new AppointmentResource($appointment);
    }
}
