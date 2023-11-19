<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.appointments.index',
            compact('appointments', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Appointment::class);

        $patients = Patient::pluck('name', 'id');
        $doctors = User::role('doctor')->pluck('name', 'id');

        return view('app.appointments.create', compact('patients', 'doctors'));
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

        return redirect()
            ->route('appointments.edit', $appointment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Appointment $appointment)
    {
        $this->authorize('view', $appointment);

        return view('app.appointments.show', compact('appointment'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $patients = Patient::pluck('name', 'id');
        $doctors = User::role('doctor')->pluck('name', 'id');

        return view(
            'app.appointments.edit',
            compact('appointment', 'patients', 'doctors')
        );
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

        return redirect()
            ->route('appointments.edit', $appointment)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('appointments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
