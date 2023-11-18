@php
    $editing = isset($assessment);
    $selectedPatient = old('patient_id', ($editing ? $assessment->patient_id : ''));
    $questions = \App\Models\Question::pluck('question_text', 'id');
    $selectedQuestion = old('question_id', ($editing ? $assessment->questions->first()->id : ''));
    $answerText = old('answer_text', ($editing ? $assessment->questions->first()->answers->first()->answer_text : ''));
@endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="patient_id" label="Patient" required>
            <option disabled {{ empty($selectedPatient) ? 'selected' : '' }}>Please select the Patient</option>
            @foreach($patients as $value => $label)
                <option value="{{ $value }}" {{ $selectedPatient == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="question_text" label="Question" required>
            <option disabled {{ empty($selectedQuestion) ? 'selected' : '' }}>Please select the Question</option>
            @foreach($questions as $value => $label)
                <option value="{{ $value }}" {{ $selectedQuestion == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text name="answer_text" label="Answer" required value="{{ $answerText }}" />
    </x-inputs.group>
</div>
