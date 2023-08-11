<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create event') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <form action="/events" method="post">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Name')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required autofocus autocomplete="name" />
                    </div>

                    <div>
                        <x-input-label class="mt-4" for="description" :value="__('Description')" />
                        <textarea id="message" rows="4" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" placeholder="Write event's description here..."></textarea>
                    </div>

                    <div class="form-group">
                        <x-input-label class="mt-4" for="date" :value="__('Date')" />
                        <x-text-input style="-webkit-calendar-picker-indicator: white" id="date" class="block mt-1 w-full" type="date" name="title" required autofocus autocomplete="date" />
                    </div>

                    <div class="form-group">
                        <x-input-label class="mt-4" for="time" :value="__('Start time')" />
                        <x-text-input id="time" class="block mt-1 w-full" type="time" name="time" required autofocus autocomplete="time" />
                    </div>

                    <div class="form-group">
                        <x-input-label class="mt-4" for="time" :value="__('End time')" />
                        <x-text-input id="time" class="block mt-1 w-full" type="time" name="time" required autofocus autocomplete="time" />
                    </div>

                    <div class="form-group">
                        <x-input-label class="mt-4" for="location" :value="__('Location')" />
                        <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" required autofocus autocomplete="location" />
                    </div>

                    <div class="flex items-center justify-center mt-4">
                        <x-primary-button class="text-center">
                            {{ __('Create Event') }}
                        </x-primary-button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>