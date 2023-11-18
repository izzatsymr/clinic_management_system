<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.appointments.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('appointments.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appointments.inputs.date_time')
                        </h5>
                        <span>{{ $appointment->date_time ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appointments.inputs.status')
                        </h5>
                        <span>{{ $appointment->status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appointments.inputs.note')
                        </h5>
                        <span>{{ $appointment->note ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appointments.inputs.patient_id')
                        </h5>
                        <span
                            >{{ optional($appointment->patient)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.appointments.inputs.user_id')
                        </h5>
                        <span
                            >{{ optional($appointment->user)->name ?? '-'
                            }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('appointments.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Appointment::class)
                    <a href="{{ route('appointments.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
