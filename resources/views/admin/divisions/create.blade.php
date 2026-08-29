<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Division') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <form method="POST" action="{{ route('admin.divisions.store') }}">

                        @csrf

                        {{-- English Name --}}
                        <div>
                            <label for="name"
                                   class="block font-medium text-sm text-gray-700">
                                English Name
                            </label>

                            <input id="name"
                                   name="name"
                                   type="text"
                                   value="{{ old('name') }}"
                                   required
                                   autofocus
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
                                   value="{{ old('name_bn') }}"
                                   class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">

                            @error('name_bn')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Buttons --}}
                        <div class="flex items-center justify-end gap-3 mt-6">

                            <a href="{{ route('admin.divisions.index') }}"
                               class="px-4 py-2 bg-gray-200 rounded-md text-gray-700 hover:bg-gray-300">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                                Save Division
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>