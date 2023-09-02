<section class="space-y-6">
    <header>

        <p class="pb-2 pl-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __('This line graph shows the number of events created by users over time within a year') }}
        </p>
    </header>

    <canvas id="participation-over-time"></canvas>
    <div id="participation-chart-data" data-labels="{{ json_encode(array_keys($eventCounts)) }}" data-data="{{ json_encode(array_values($eventCounts)) }}"></div>
</section>