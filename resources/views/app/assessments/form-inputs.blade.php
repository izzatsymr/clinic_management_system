@php
$editing = isset($assessment);
$selectedPatient = old('patient_id', ($editing ? $assessment->patient_id : request('patient_id')));
@endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="patient_id" label="Patient" required>
            <option disabled {{ empty($selectedPatient) ? 'selected' : '' }}>Please select the Patient</option>
            @foreach($patients as $value => $label)
            <option value="{{ $value }}" {{ $selectedPatient==$value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>