<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('District Details') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <div class="space-y-6">

                        {{-- Division --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Division
                            </p>

                            <p class="mt-1 text-lg font-medium text-gray-900">
                                {{ $district->division->name ?? '—' }}

                                @if ($district->division?->name_bn)
                                    — {{ $district->division->name_bn }}
                                @endif
                            </p>

                        </div>


                        {{-- District --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                District Name
                            </p>

                            <p class="mt-1 text-lg font-medium text-gray-900">
                                {{ $district->name }}
                            </p>

                        </div>


                        {{-- Bangla --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                বাংলা নাম
                            </p>

                            <p class="mt-1 text-lg font-medium text-gray-900">
                                {{ $district->name_bn ?? '—' }}
                            </p>

                        </div>


                        {{-- Status --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Status
                            </p>

                            <p class="mt-1">

                                @if ($district->is_active)

                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>

                                @else

                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                        Inactive
                                    </span>

                                @endif

                            </p>

                        </div>

                    </div>


                    {{-- Actions --}}
                    <div class="flex items-center justify-end gap-3 mt-8">

                        <a href="{{ route('admin.districts.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded-md text-gray-700 hover:bg-gray-300">
                            Back
                        </a>

                        <a href="{{ route('admin.districts.edit', $district) }}"
                           class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                            Edit District
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>