<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\AppointmentCollection;
use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\AppointmentUpdateRequest;

class AppointmentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Appointment::class);

        $search = $request->get('search', '');

        $appointments = Appointment::search($search)
            ->latest()
            ->paginate();

        return new AppointmentCollection($appointments);
    }

    /**
     * @param \App\Http\Requests\AppointmentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentStoreRequest $request)
    {
        $this->authorize('create', Appointment::class);

        $validated = $request->validated();

        $appointment = Appointment::create($validated);

        return new AppointmentResource($appointment);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Appointment $appointment)
    {
        $this->authorize('view', $appointment);

        return new AppointmentResource($appointment);
    }

    /**
     * @param \App\Http\Requests\AppointmentUpdateRequest $request
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(
        AppointmentUpdateRequest $request,
        Appointment $appointment
    ) {
        $this->authorize('update', $appointment);

        $validated = $request->validated();

        $appointment->update($validated);

        return new AppointmentResource($appointment);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Appointment $appointment)
    {
        $this->authorize('delete', $appointment);

        $appointment->delete();

        return response()->noContent();
    }
}
