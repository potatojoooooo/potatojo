<section class="space-y-6">
    <header>

        <p class="pb-2 pl-2 text-sm text-gray-900">
            {{ __('This bar chart shows the total of event durations created') }}
        </p>
    </header>
    
    <canvas id="event-durations"></canvas>
    <div id="event-durations-data" data-durations="{{ json_encode($durations) }}">
    </div>
</section>