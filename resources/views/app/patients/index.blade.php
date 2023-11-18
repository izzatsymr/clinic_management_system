<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.patients.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Patient::class)
                            <a
                                href="{{ route('patients.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.patients.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.patients.inputs.contact_no')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.patients.inputs.address')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.patients.inputs.email')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.patients.inputs.emergency_contact')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.patients.inputs.date_of_birth')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.patients.inputs.gender')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.patients.inputs.medical_history')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($patients as $patient)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $patient->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $patient->contact_no ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $patient->address ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $patient->email ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $patient->emergency_contact ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $patient->date_of_birth ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $patient->gender ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $patient->medical_history ?? '-' }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $patient)
                                        <a
                                            href="{{ route('patients.edit', $patient) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $patient)
                                        <a
                                            href="{{ route('patients.show', $patient) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $patient)
                                        <form
                                            action="{{ route('patients.destroy', $patient) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="9">
                                    <div class="mt-10 px-4">
                                        {!! $patients->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
