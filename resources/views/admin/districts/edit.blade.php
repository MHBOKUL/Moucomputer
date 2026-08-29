<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit District') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <form method="POST"
                          action="{{ route('admin.districts.update', $district) }}">

                        @csrf
                        @method('PUT')


                        {{-- Division --}}
                        <div>

                            <label for="division_id"
                                   class="block font-medium text-sm text-gray-700">
                                Division
                            </label>

                            <select id="division_id"
                                    name="division_id"
                                    required
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">

                                @foreach ($divisions as $division)

                                    <option value="{{ $division->id }}"
                                        {{ old('division_id', $district->division_id) == $division->id ? 'selected' : '' }}>

                                        {{ $division->name }}

                                        @if ($division->name_bn)
                                            — {{ $division->name_bn }}
                                        @endif

                                    </option>

                                @endforeach

                            </select>

                            @error('division_id')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- English Name --}}
                        <div class="mt-6">

                            <label for="name"
                                   class="block font-medium text-sm text-gray-700">
                                District Name
                            </label>

                            <input id="name"
                                   name="name"
                                   type="text"
                                   value="{{ old('name', $district->name) }}"
                                   required
                                   class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">

                            @error('name')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Bangla Name --}}
                        <div class="mt-6">

                            <label for="name_bn"
                                   class="block font-medium text-sm text-gray-700">
                                বাংলা নাম
                            </label>

                            <input id="name_bn"
                                   name="name_bn"
                                   type="text"
                                   value="{{ old('name_bn', $district->name_bn) }}"
                                   class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">

                            @error('name_bn')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Status --}}
                        <div class="mt-6">

                            <label class="inline-flex items-center">

                                <input type="checkbox"
                                       name="is_active"
                                       value="1"
                                       {{ old('is_active', $district->is_active) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-gray-800 shadow-sm">

                                <span class="ms-2 text-sm text-gray-600">
                                    Active
                                </span>

                            </label>

                        </div>


                        {{-- Buttons --}}
                        <div class="flex items-center justify-end gap-3 mt-6">

                            <a href="{{ route('admin.districts.index') }}"
                               class="px-4 py-2 bg-gray-200 rounded-md text-gray-700 hover:bg-gray-300">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                                Update District
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>