@php $editing = isset($question) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="question_text"
            label="Question Text"
            :value="old('question_text', ($editing ? $question->question_text : ''))"
            maxlength="255"
            placeholder="Question Text"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="assessment_id" label="Assessment" required>
            @php $selected = old('assessment_id', ($editing ? $question->assessment_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Assessment</option>
            @foreach($assessments as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
