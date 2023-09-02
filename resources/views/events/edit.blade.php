<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit event') }}
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
                    <form method="POST" action="{{ route('events.update', $event->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input value="{{ $event->name }}" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                        </div>

                        <div>
                            <x-input-label class="mt-4" for="description" :value="__('Description')" />
                            <textarea value="" name="description" rows="4" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" placeholder="Write event's description here..." required autofocus>{{ $event->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <x-input-label class="mt-4" for="location" :value="__('Location')" />
                            <x-text-input value="{{ $event->location }}" class="block mt-1 w-full" type="text" name="location" id="location" required autofocus autocomplete="location" />
                        </div>

                        <div class="form-group">
                            <x-input-label class="mt-4" for="date" :value="__('Date')" />
                            <x-text-input value="{{ $event->date }}" class="block mt-1 w-full" type="date" name="date" required autofocus autocomplete="date" />
                        </div>

                        <div class="form-group">
                            <x-input-label class="mt-4" for="start_time" :value="__('Start time')" />
                            <x-text-input value="{{ $event->start_time }}" class="block mt-1 w-full" type="time" name="start_time" required autofocus autocomplete="time" />
                        </div>

                        <div class="form-group">
                            <x-input-label class="mt-4" for="end_time" :value="__('End time')" />
                            <x-text-input value="{{ $event->end_time }}" class="block mt-1 w-full" type="time" name="end_time" required autofocus autocomplete="time" />
                        </div>
                        <div class="form-group">
                            <x-input-label class="mt-4" for="participants_needed" :value="__('Participants needed')" />
                            <x-text-input value="{{ $event->participants_needed }}" class="block mt-1 w-full" type="number" name="participants_needed" required autofocus />
                        </div>
                        <div class="flex items-center justify-center mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Update event') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>