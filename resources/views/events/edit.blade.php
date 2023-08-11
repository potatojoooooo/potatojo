<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit event') }}
        </h2>
    </x-slot>
    <div class="container">
        <form method="POST" action="{{ route('events.update', $event->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $event->name }}" required>
            </div>
            <!-- Add more form fields for description, location, date, start_time, and end_time -->
            <button type="submit" class="btn btn-primary">Update Event</button>
        </form>
    </div>
</x-app-layout>