@php $editing = isset($assessment) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="patient_id" label="Patient" required>
            @php $selectedPatient = old('patient_id', ($editing ? $assessment->patient_id : '')) @endphp
            <option disabled {{ empty($selectedPatient) ? 'selected' : '' }}>Please select the Patient</option>
            @foreach($patients as $value => $label)
            <option value="{{ $value }}" {{ $selectedPatient==$value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>