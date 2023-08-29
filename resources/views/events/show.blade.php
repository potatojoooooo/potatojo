<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Event details
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="display: inline-flex;">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="row ">
                    <div class="col-md-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
                            <tbody>
                                <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        Event:
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{$event -> name}}
                                    </td>
                                </tr>
                                <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        Description:
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{$event -> description}}
                                    </td>
                                </tr>
                                <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        Location:
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{$event -> location}}
                                    </td>
                                </tr>
                                <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        Date:
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{$event -> date}}
                                    </td>
                                </tr>
                                <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        Start time:
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{$event -> start_time}}
                                    </td>
                                </tr>
                                <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        End time:
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{$event -> end_time}}
                                    </td>
                                </tr>
                                <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        Created by:
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{$event -> users -> name}}
                                    </td>
                                </tr>
                                <tr class="">
                                    <td colspan="2" scope="row" class="px-6 py-4 ">
                                        <div class="justify-between">
                                            @if ($isCreator)
                                            <x-primary-button class="text-center">
                                                <a href="{{ route('events.edit', $event->id)}}">{{ __('Edit') }}</a>
                                            </x-primary-button>
                                            <form method="POST" action="{{ route('events.destroy', $event->id) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <x-primary-button class="text-center focus:outline-none text-white bg-red-700  focus:ring-4 focus:ring-red-300 dark:bg-red-600  dark:focus:ring-red-900 ">
                                                    <a href="#" class="text-white">{{ __('Delete') }}</a>
                                                </x-primary-button>
                                            </form>
                                            @else
                                            <x-primary-button class="" id="join-event-button">
                                                {{ __('Join event') }}
                                            </x-primary-button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>