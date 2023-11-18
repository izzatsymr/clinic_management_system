@php $editing = isset($patient) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $patient->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="contact_no"
            label="Contact No"
            :value="old('contact_no', ($editing ? $patient->contact_no : ''))"
            maxlength="255"
            placeholder="Contact No"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="address"
            label="Address"
            :value="old('address', ($editing ? $patient->address : ''))"
            maxlength="255"
            placeholder="Address"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $patient->email : ''))"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="emergency_contact"
            label="Emergency Contact"
            :value="old('emergency_contact', ($editing ? $patient->emergency_contact : ''))"
            maxlength="255"
            placeholder="Emergency Contact"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date_of_birth"
            label="Date Of Birth"
            value="{{ old('date_of_birth', ($editing ? optional($patient->date_of_birth)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="gender" label="Gender">
            @php $selected = old('gender', ($editing ? $patient->gender : '')) @endphp
            <option value="male" {{ $selected == 'male' ? 'selected' : '' }} >Male</option>
            <option value="female" {{ $selected == 'female' ? 'selected' : '' }} >Female</option>
            <option value="other" {{ $selected == 'other' ? 'selected' : '' }} >Other</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="medical_history"
            label="Medical History"
            :value="old('medical_history', ($editing ? $patient->medical_history : ''))"
            maxlength="255"
            placeholder="Medical History"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
