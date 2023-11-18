<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.assessments.create_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('assessments.index') }}" class="mr-4"><i
                            class="mr-1 icon ion-md-arrow-back"></i></a>
                </x-slot>

                <x-form method="POST" action="{{ route('assessments.store') }}" class="mt-4" id="assessment-form">
                    @include('app.assessments.form-inputs')
                    @include('app.assessments.question-answer-inputs')

                    <!-- Container to hold additional question-answer inputs -->
                    <div id="additional-question-inputs"></div>

                    <button type="button" class="button ml-2" onclick="addMoreQuestion()">
                        Add More Question
                    </button>

                    <div class="mt-10">
                        <a href="{{ route('assessments.index') }}" class="button">
                            <i class="
                                    mr-1
                                    icon
                                    ion-md-return-left
                                    text-primary
                                "></i>
                            @lang('crud.common.back')
                        </a>

                        <button type="submit" class="button button-primary float-right">
                            <i class="mr-1 icon ion-md-save"></i>
                            @lang('crud.common.create')
                        </button>

                    </div>
                </x-form>
            </x-partials.card>
        </div>
    </div>
    <!-- ... (your existing code) ... -->

    <script>
        function addMoreQuestion() {
            const container = document.getElementById('additional-question-inputs');
            const newIndex = container.children.length + 1;

            const newQuestionDiv = document.createElement('div');
            newQuestionDiv.innerHTML = `
            <div class="mt-4">
                <x-inputs.group class="w-full">
                    <x-inputs.select name="questions[${newIndex}][question_id]" label="Question" required>
                        <option disabled selected>Please select the Question</option>
                        @foreach($questions as $questionId => $questionText)
                            <option value="{{ $questionId }}">{{ $questionText }}</option>
                        @endforeach
                    </x-inputs.select>
                </x-inputs.group>

                <x-inputs.group class="w-full">
                    <x-inputs.text name="questions[${newIndex}][answer_text]" label="Answer Text" required></x-inputs.text>
                </x-inputs.group>
            </div>
        `;

            container.appendChild(newQuestionDiv);
        }
    </script>

    <!-- ... (your existing code) ... -->

</x-app-layout>