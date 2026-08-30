<x-app-layout>


<div class="min-h-screen bg-gray-50">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="bg-white border-b border-gray-200">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <div class="text-center">

                <div class="inline-flex items-center gap-2 mb-3">
                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>

                    <span class="text-sm font-bold uppercase tracking-wider text-blue-600">
                        Mouza Map
                    </span>
                </div>

                <h1 class="text-3xl sm:text-4xl font-extrabold text-black">
                    Find Your Mouza Map
                </h1>

                <p class="mt-3 text-black">
                    Select the location step by step to find your required map.
                </p>

            </div>

        </div>

    </div>


    {{-- =========================================================
        MAIN SEARCH FORM
    ========================================================== --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">


            {{-- Form Header --}}
            <div class="px-6 sm:px-8 py-6 border-b border-gray-200">

                <h2 class="text-xl sm:text-2xl font-bold text-black">
                    Search Mouza Map
                </h2>

                <p class="mt-1 text-sm text-black">
                    Choose Division, District, Upazila and Mouza.
                </p>

            </div>


            {{-- Form Body --}}
            <div class="p-6 sm:p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                    {{-- =================================================
                        DIVISION
                    ================================================== --}}
                    <div>

                        <label
                            for="division"
                            class="block text-sm font-bold text-black mb-2"
                        >
                            Division
                        </label>

                        <select
                            id="division"
                            name="division"
                            class="w-full rounded-xl
                                   border border-gray-300
                                   bg-white
                                   px-4 py-3
                                   text-black
                                   font-medium
                                   focus:border-blue-600
                                   focus:ring-2
                                   focus:ring-blue-100
                                   outline-none
                                   transition"
                        >

                            <option value="">
                                Select Division
                            </option>

                            @foreach($divisions as $division)

                                <option value="{{ $division->id }}">
                                    {{ $division->name }}

                                    @if($division->name_bn)
                                        — {{ $division->name_bn }}
                                    @endif
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- =================================================
                        DISTRICT
                    ================================================== --}}
                    <div>

                        <label
                            for="district"
                            class="block text-sm font-bold text-black mb-2"
                        >
                            District
                        </label>

                        <select
                            id="district"
                            name="district"
                            disabled
                            class="w-full rounded-xl
                                   border border-gray-300
                                   bg-gray-100
                                   px-4 py-3
                                   text-black
                                   font-medium
                                   outline-none
                                   transition"
                        >

                            <option value="">
                                Select Division First
                            </option>

                        </select>

                    </div>


                    {{-- =================================================
                        UPAZILA
                    ================================================== --}}
                    <div>

                        <label
                            for="upazila"
                            class="block text-sm font-bold text-black mb-2"
                        >
                            Upazila
                        </label>

                        <select
                            id="upazila"
                            name="upazila"
                            disabled
                            class="w-full rounded-xl
                                   border border-gray-300
                                   bg-gray-100
                                   px-4 py-3
                                   text-black
                                   font-medium
                                   outline-none
                                   transition"
                        >

                            <option value="">
                                Select District First
                            </option>

                        </select>

                    </div>


                    {{-- =================================================
                        MOUZA
                    ================================================== --}}
                    <div>

                        <label
                            for="mouza"
                            class="block text-sm font-bold text-black mb-2"
                        >
                            Mouza
                        </label>

                        <select
                            id="mouza"
                            name="mouza"
                            disabled
                            class="w-full rounded-xl
                                   border border-gray-300
                                   bg-gray-100
                                   px-4 py-3
                                   text-black
                                   font-medium
                                   outline-none
                                   transition"
                        >

                            <option value="">
                                Select Upazila First
                            </option>

                        </select>

                    </div>

                </div>


                {{-- =====================================================
                    LOADING MESSAGE
                ====================================================== --}}
                <div
                    id="loading"
                    class="hidden mt-6
                           rounded-xl
                           border border-blue-200
                           bg-blue-50
                           px-4 py-3
                           text-sm font-semibold
                           text-black"
                >
                    Loading...
                </div>


                {{-- =====================================================
                    MAP RESULTS
                ====================================================== --}}
                <div id="map-results" class="hidden mt-8">

                    <div class="border-t border-gray-200 pt-8">

                        <div class="flex flex-col sm:flex-row
                                    sm:items-center
                                    sm:justify-between
                                    gap-3 mb-5">

                            <div>

                                <h3 class="text-xl font-bold text-black">
                                    Available Maps
                                </h3>

                                <p class="mt-1 text-sm text-black">
                                    Select a map to view details and place your order.
                                </p>

                            </div>

                        </div>


                        <div
                            id="map-list"
                            class="grid grid-cols-1 sm:grid-cols-2 gap-5"
                        >
                        </div>

                    </div>

                </div>


                {{-- =====================================================
                    NO MAP MESSAGE
                ====================================================== --}}
                <div
                    id="no-maps"
                    class="hidden mt-8
                           rounded-xl
                           border border-gray-200
                           bg-gray-50
                           p-8
                           text-center"
                >

                    <div
                        class="mx-auto w-12 h-12
                               rounded-xl
                               bg-white
                               border border-gray-200
                               flex items-center justify-center"
                    >

                        <svg
                            class="w-6 h-6 text-black"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M9 20l-5-2V6l5 2m0 12l6-2m-6 2V8m6 10l6 2V8l-6-2m0 12V6"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-4 font-bold text-black">
                        No Maps Available
                    </h3>

                    <p class="mt-1 text-sm text-black">
                        No map is currently available for this Mouza.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =============================================================
    JAVASCRIPT
============================================================== --}}
<script>

    document.addEventListener('DOMContentLoaded', function () {

        const division = document.getElementById('division');
        const district = document.getElementById('district');
        const upazila = document.getElementById('upazila');
        const mouza = document.getElementById('mouza');

        const loading = document.getElementById('loading');
        const mapResults = document.getElementById('map-results');
        const mapList = document.getElementById('map-list');
        const noMaps = document.getElementById('no-maps');


        /*
        |--------------------------------------------------------------------------
        | Helper: Reset Select
        |--------------------------------------------------------------------------
        */

        function resetSelect(select, text) {

            select.innerHTML = '';

            const option = document.createElement('option');

            option.value = '';
            option.textContent = text;

            select.appendChild(option);

            select.disabled = true;

            select.classList.remove(
                'bg-white',
                'border-blue-500'
            );

            select.classList.add('bg-gray-100');

        }


        /*
        |--------------------------------------------------------------------------
        | Helper: Enable Select
        |--------------------------------------------------------------------------
        */

        function enableSelect(select) {

            select.disabled = false;

            select.classList.remove('bg-gray-100');

            select.classList.add('bg-white');

        }


        /*
        |--------------------------------------------------------------------------
        | Helper: Loading
        |--------------------------------------------------------------------------
        */

        function showLoading() {
            loading.classList.remove('hidden');
        }

        function hideLoading() {
            loading.classList.add('hidden');
        }


        /*
        |--------------------------------------------------------------------------
        | Reset Lower Levels
        |--------------------------------------------------------------------------
        */

        function resetDistrict() {
            resetSelect(district, 'Select Division First');
        }

        function resetUpazila() {
            resetSelect(upazila, 'Select District First');
        }

        function resetMouza() {
            resetSelect(mouza, 'Select Upazila First');
        }


        /*
        |--------------------------------------------------------------------------
        | DIVISION CHANGE
        |--------------------------------------------------------------------------
        */

        division.addEventListener('change', async function () {

            const divisionId = this.value;

            resetDistrict();
            resetUpazila();
            resetMouza();

            mapResults.classList.add('hidden');
            noMaps.classList.add('hidden');
            mapList.innerHTML = '';

            if (!divisionId) {
                return;
            }

            showLoading();

            try {

                const response = await fetch(
                    `/maps/browse/divisions/${divisionId}/districts`
                );

                if (!response.ok) {
                    throw new Error('Failed to load districts.');
                }

                const districts = await response.json();

                district.innerHTML = '';

                const firstOption = document.createElement('option');

                firstOption.value = '';
                firstOption.textContent = 'Select District';

                district.appendChild(firstOption);


                districts.forEach(function (item) {

                    const option = document.createElement('option');

                    option.value = item.id;

                    option.textContent =
                        item.name +
                        (item.name_bn ? ' — ' + item.name_bn : '');

                    district.appendChild(option);

                });


                enableSelect(district);

            } catch (error) {

                console.error(error);

                resetDistrict();

            } finally {

                hideLoading();

            }

        });


        /*
        |--------------------------------------------------------------------------
        | DISTRICT CHANGE
        |--------------------------------------------------------------------------
        */

        district.addEventListener('change', async function () {

            const districtId = this.value;

            resetUpazila();
            resetMouza();

            mapResults.classList.add('hidden');
            noMaps.classList.add('hidden');
            mapList.innerHTML = '';

            if (!districtId) {
                return;
            }

            showLoading();

            try {

                const response = await fetch(
                    `/maps/browse/districts/${districtId}/upazilas`
                );

                if (!response.ok) {
                    throw new Error('Failed to load upazilas.');
                }

                const upazilas = await response.json();

                upazila.innerHTML = '';

                const firstOption = document.createElement('option');

                firstOption.value = '';
                firstOption.textContent = 'Select Upazila';

                upazila.appendChild(firstOption);


                upazilas.forEach(function (item) {

                    const option = document.createElement('option');

                    option.value = item.id;

                    option.textContent =
                        item.name +
                        (item.name_bn ? ' — ' + item.name_bn : '');

                    upazila.appendChild(option);

                });


                enableSelect(upazila);

            } catch (error) {

                console.error(error);

                resetUpazila();

            } finally {

                hideLoading();

            }

        });


        /*
        |--------------------------------------------------------------------------
        | UPAZILA CHANGE
        |--------------------------------------------------------------------------
        */

        upazila.addEventListener('change', async function () {

            const upazilaId = this.value;

            resetMouza();

            mapResults.classList.add('hidden');
            noMaps.classList.add('hidden');
            mapList.innerHTML = '';

            if (!upazilaId) {
                return;
            }

            showLoading();

            try {

                const response = await fetch(
                    `/maps/browse/upazilas/${upazilaId}/mouzas`
                );

                if (!response.ok) {
                    throw new Error('Failed to load mouzas.');
                }

                const mouzas = await response.json();

                mouza.innerHTML = '';

                const firstOption = document.createElement('option');

                firstOption.value = '';
                firstOption.textContent = 'Select Mouza';

                mouza.appendChild(firstOption);


                mouzas.forEach(function (item) {

                    const option = document.createElement('option');

                    option.value = item.id;

                    option.textContent =
                        item.name +
                        (item.name_bn ? ' — ' + item.name_bn : '');

                    mouza.appendChild(option);

                });


                enableSelect(mouza);

            } catch (error) {

                console.error(error);

                resetMouza();

            } finally {

                hideLoading();

            }

        });


        /*
        |--------------------------------------------------------------------------
        | MOUZA CHANGE
        |--------------------------------------------------------------------------
        */

        mouza.addEventListener('change', async function () {

            const mouzaId = this.value;

            mapResults.classList.add('hidden');
            noMaps.classList.add('hidden');
            mapList.innerHTML = '';

            if (!mouzaId) {
                return;
            }

            showLoading();

            try {

                const response = await fetch(
                    `/maps/browse/mouzas/${mouzaId}/maps`
                );

                if (!response.ok) {
                    throw new Error('Failed to load maps.');
                }

                const maps = await response.json();


                if (!maps.length) {

                    noMaps.classList.remove('hidden');

                    return;

                }


                maps.forEach(function (map) {

                    const card = document.createElement('div');

                    card.className =
                        'bg-white border border-gray-200 rounded-2xl p-5 shadow-sm hover:shadow-lg hover:border-blue-500 transition';


                    card.innerHTML = `

                        <div class="flex items-start justify-between gap-4">

                            <div
                                class="w-11 h-11 rounded-xl
                                       bg-blue-50
                                       border border-blue-100
                                       flex items-center justify-center"
                            >

                                <svg
                                    class="w-5 h-5 text-blue-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M7 3h7l4 4v14H7V3z"
                                    />
                                </svg>

                            </div>

                            <span
                                class="text-lg font-extrabold text-black"
                            >
                                ৳ ${map.price}
                            </span>

                        </div>


                        <h4
                            class="mt-5 text-lg font-bold text-black"
                        >
                            ${map.title}
                        </h4>


                        <p
                            class="mt-1 text-sm text-black"
                        >
                            ${map.file_name ?? 'PDF Map'}
                        </p>


                     <a
    href="/maps/${map.id}"
    class="mt-5
           inline-flex
           items-center
           justify-center
           w-full
           rounded-xl
           bg-white
           px-4 py-3
           text-sm
           font-bold
           text-black
           border-2
           border-gray-300
           shadow-sm
           hover:bg-gray-100
           hover:border-black
           hover:shadow-md
           transition-all
           duration-200"
>
    <span>View Map Details</span>

    <svg
        class="ml-2 w-4 h-4"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M9 5l7 7-7 7"
        />
    </svg>
</a>

                    `;

                    mapList.appendChild(card);

                });


                mapResults.classList.remove('hidden');

            } catch (error) {

                console.error(error);

            } finally {

                hideLoading();

            }

        });

    });

</script>


</x-app-layout>
