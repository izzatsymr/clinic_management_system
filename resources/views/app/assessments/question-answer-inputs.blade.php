@php $editing = isset($assessment) @endphp
<!-- question-answer-inputs.blade.php -->
<div id="question-answer-inputs" class="mt-4">
    <x-inputs.group class="w-full">
        <x-inputs.select name="questions[0][question_id]" label="Question" required>
            @php
            $selectedQuestion = old('question_id', ($editing && $assessment->questions->isNotEmpty() ?
            $assessment->questions->first()->id : ''));
            @endphp
            <option disabled {{ empty($selectedQuestion) ? 'selected' : '' }}>Please select the Question</option>
            @foreach($questions as $questionId => $questionText)
            <option value="{{ $questionId }}" {{ $selectedQuestion==$questionId ? 'selected' : '' }}>
                {{ $questionText }}
            </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text name="questions[0][answer_text]" label="Answer Text" required></x-inputs.text>
    </x-inputs.group>
</div>