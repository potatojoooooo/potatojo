<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Joined events
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-12">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-gray-900 dark:text-gray-100">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-gray-900 dark:text-gray-100 text-ellipsis">
                            Location
                        </th>
                        <th scope="col" class="px-6 py-3 text-gray-900 dark:text-gray-100">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-gray-900 dark:text-gray-100">
                            Time
                        </th>
                        <th scope="col" class="px-6 py-3 text-gray-900 dark:text-gray-100">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($joinedEvents as $event)
                    <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700 event-row">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$event->name}}
                        </th>
                        <td class="px-6 py-4">
                            {{$event->location}}
                        </td>
                        <td class="px-6 py-4">
                            {{$event->date}}
                        </td>
                        <td class="px-6 py-4">
                            {{$event -> start_time}}
                        </td>
                        <td class="px-6 py-4">
                            <x-primary-button class="text-center">
                                <a href="{{ route('events.show', $event->id)}}">{{ __('View details') }}</a>
                            </x-primary-button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>