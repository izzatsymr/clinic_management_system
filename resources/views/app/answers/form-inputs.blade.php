@php $editing = isset($answer) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="answer_text"
            label="Answer Text"
            :value="old('answer_text', ($editing ? $answer->answer_text : ''))"
            maxlength="255"
            placeholder="Answer Text"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="question_id" label="Question" required>
            @php $selected = old('question_id', ($editing ? $answer->question_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Question</option>
            @foreach($questions as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
