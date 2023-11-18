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
</div>
