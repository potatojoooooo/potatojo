<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Event details
        </h2>
    </x-slot>
    <div class="grid grid-cols-2 max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class=" bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class=" p-6 text-gray-900 dark:text-gray-100">
                <div class="row w-full">
                    <div class="col-md-4">
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="m-6" id="map" style="width: 100%; height: 500px;">

        </div>
    </div>
</x-app-layout>