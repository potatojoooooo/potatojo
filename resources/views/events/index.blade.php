<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Events around you') }}
            </h2>
            <div class="flex justify-between items-center">
                <div class="mx-2 w-80">
                    <form action="{{ route('events.search')}}" method="GET" role="search">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" name="search" id="default-search" class="block w-full pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 form-control" placeholder="Badminton, photography..." value="{{Request::get('search')}}" required>
                            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                        </div>
                    </form>
                </div>
                <x-primary-button class="text-center">
                    <a href="{{ route('events.create')}}">{{ __('Create Event') }}</a>
                </x-primary-button>
            </div>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
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
                        <th scope="col" class="px-6 py-3 text-gray-900 dark:text-gray-100 text-ellipsis">
                            Distance To
                        </th>
                        <th scope="col" class="px-6 py-3 text-gray-900 dark:text-gray-100">
                            Duration
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
                            <div class="event-location" data-location="{{ $event->city }}"></div>
                            <input type="text" class="dkm bg-transparent border-none w-24 " readonly name="dkm">
                        </td>
                        <td class="px-6 py-4">
                            <input type="text" class="dtime bg-transparent border-none w-24" readonly name="dtime">
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