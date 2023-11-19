@php $editing = isset($appointment) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="patient_id" label="Patient" required>
            @php $selected = old('patient_id', ($editing ? $appointment->patient_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Patient</option>
            @foreach($patients as $value => $label)
            <option value="{{ $value }}" {{ $selected==$value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="Doctor" required>
            @php
            $selected = old('user_id', ($editing ? $appointment->user_id : ''));
            $doctors = \App\Models\User::role('doctor')->pluck('name', 'id');
            @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Doctor</option>
            @foreach($doctors as $value => $label)
            <option value="{{ $value }}" {{ $selected==$value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
    <x-inputs.group class="w-full">
        <x-inputs.datetime name="date_time" label="Date Time"
            value="{{ old('date_time', ($editing ? optional($appointment->date_time)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255" required></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $appointment->status : '')) @endphp
            <option value="scheduled" {{ $selected=='scheduled' ? 'selected' : '' }}>Scheduled</option>
            <option value="completed" {{ $selected=='completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ $selected=='cancelled' ? 'selected' : '' }}>Cancelled</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text name="note" label="Note" :value="old('note', ($editing ? $appointment->note : ''))"
            maxlength="255" placeholder="Note" required></x-inputs.text>
    </x-inputs.group>


</div>