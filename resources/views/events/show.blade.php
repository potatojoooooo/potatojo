<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $event->name }}
        </h2>
    </x-slot>
    <div class="container">
        <h1>{{ $event->name }}</h1>
        <p>Description: {{ $event->description }}</p>
        <p>Location: {{ $event->location }}</p>
        <p>Date: {{ $event->date }}</p>
        <p>Start Time: {{ $event->start_time }}</p>
        <p>End Time: {{ $event->end_time }}</p>
        <p>Created By: {{ $event->users->name }}</p>
        @if ($isCreator)
        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-primary">Edit Event</a>
        <form method="POST" action="{{ route('events.destroy', $event->id) }}" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Event</button>
        </form>
        @endif
    </div>
</x-app-layout>