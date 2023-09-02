<section class="space-y-6">
    <header>

        <p class="pb-2 pl-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __('This pie chart') }}
        </p>
    </header>

    <canvas id="event-categories"></canvas>
    <div id="category-data" data-category-names="{{ json_encode($eventCategories->keys()->toArray()) }}" data-category-counts="{{ json_encode($eventCategories->values()->toArray()) }}"></div>
    </div>
</section>