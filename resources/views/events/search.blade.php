<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                "{{$search}}" {{ __('events around you') }}
            </h2>

        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if (count($events) > 0)
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-gray-900 dark:text-gray-100">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-gray-900 dark:text-gray-100 text-ellipsis">
                            Location
                        </th>
                        <th scope="col" class="px-6 py-3 text-gray-900 dark:text-gray-100 text-ellipsis">
                            Distance
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
                    <input type="hidden" id="city" class="city" name="city" value="{{$userCity}}">
                    @foreach ($events as $event)
                    <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700 event-row">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$event->name}}
                        </th>
                        <td class="px-6 py-4">
                            {{$event->location}}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <div class="event-location" data-location="{{ $event->city }}"></div>
                                <input style="max-width: 102px;" type="text" class="p-0 dkm bg-transparent border-none font-medium whitespace-nowrap" readonly name="dkm">
                            </div>
                            <div class="flex flex-col">
                                <input style="max-width: 102px;" type="text" class="p-0 w-auto dtime bg-transparent border-none" readonly name="dtime">
                            </div>
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
            @else
            <h2 class="no-underline	font-semibold text-xl text-center text-gray-800 dark:text-gray-200 ">
                Sorry, no nearby event found. :(
            </h2>
            @endif
        </div>
    </div>
</x-app-layout>