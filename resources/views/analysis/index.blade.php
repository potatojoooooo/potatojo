<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Analysis') }}
        </h2>
    </x-slot>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pb-2 pl-2">Events Created</h2>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-indigo-100 p-6 text-gray-900 dark:text-gray-100">
                    @include('analysis.partials.event-participation', ['eventCounts' => $eventCounts])
                </div>
            </div>

        </div>
    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pb-2 pl-2">Events' Durations</h2>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-indigo-100 p-6 text-gray-900 dark:text-gray-100">
                    @include('analysis.partials.event-durations', ['durations' => $durations])
                </div>
            </div>
        </div>
    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pb-2 pl-2">Events' Categories</h2>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-indigo-100 p-6 text-gray-900 dark:text-gray-100">
                    @include('analysis.partials.event-categories', ['eventCategories' => $eventCategories])
                </div>
            </div>

        </div>
    </div>
</x-app-layout>