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
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('events.store') }}">
                        @csrf

                        <div class="form-group">
                            <x-input-label :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                        </div>

                        <div class="form-group">
                            <x-input-label class="mt-4" :value="__('Description')" />
                            <textarea name="description" rows="4" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" placeholder="Write event's description here..." required autofocus></textarea>
                        </div>

                        <div class="form-group">
                            <x-input-label class="mt-4" :value="__('Location / Shop Name')" />
                            <x-text-input id="locationName" class="block mt-1 w-full" type="text" name="locationName" required autofocus />
                        </div>

                        <div class="form-group">
                            <x-input-label class="mt-4" :value="__('City')" />
                            <x-text-input class="block mt-1 w-full" type="text" name="location" id="location" required autofocus autocomplete="location" />
                        </div>

                        <div class="form-group">
                            <x-input-label class="mt-4" :value="__('Date')" />
                            <x-text-input class="block mt-1 w-full" type="date" name="date" required autofocus autocomplete="date" />
                        </div>

                        <div class="form-group">
                            <x-input-label class="mt-4" :value="__('Start time')" />
                            <x-text-input class="block mt-1 w-full" type="time" name="start_time" required autofocus autocomplete="time" />
                        </div>

                        <div class="form-group">
                            <x-input-label class="mt-4" for="end_time" :value="__('End time')" />
                            <x-text-input class="block mt-1 w-full" type="time" name="end_time" required autofocus autocomplete="time" />
                        </div>

                        <div class="form-group">
                            <x-input-label class="mt-4" for="end_time" :value="__('Participants needed')" />
                            <x-text-input class="block mt-1 w-full" type="number" name="participants_needed" required autofocus />
                        </div>

                        <div class="form-group">
                            <x-input-label class="mt-4" for="category_id" :value="__('Event Category')" />
                            <select class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="category_id" required autofocus>
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="flex items-center justify-center mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create event') }}
                            </x-primary-button>
                        </div>

                        <input type="hidden" id="ip" name="ip">
                        <input type="hidden" id="long" name="long">
                        <input type="hidden" id="lat" name="lat">
                        <input type="hidden" id="city" name="city">
                        <!-- change to type="hidden" -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>