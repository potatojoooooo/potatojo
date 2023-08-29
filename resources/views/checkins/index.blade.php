<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Check-ins') }}
            </h2>
            <div class="flex justify-between items-center">

                <x-primary-button class="text-center">
                    <a href="{{ route('checkins.create')}}">{{ __('Create Check-in') }}</a>
                </x-primary-button>
            </div>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($checkIns as $checkIn)
                <div class="w-full my-4 max-w-sm bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex px-4 pt-4">
                    </div>
                    <div class="flex flex-col items-center mb-5">
                        <h5 class="text-center mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $checkIn->location }}</h5>
                        <span class="my-2 font-extrabold text-ellipsis overflow-hidden mx-10 text-sm text-gray-500 dark:text-gray-400">{{ $checkIn->check_in_notes }}</span>
                        <span class="text-ellipsis overflow-hidden mx-10 text-sm text-gray-500 dark:text-gray-400">Visited on {{ $checkIn->created_at->timezone('Asia/Kuala_Lumpur')->format('d-m-Y g:i A')  }}</span>
                    </div>
                    <div class="items-center flex justify-center my-4">
                        <x-primary-button class="text-center mx-2">
                            <a href="{{ route('checkins.edit', $checkIn->id)}}">{{ __('Edit') }}</a>
                        </x-primary-button>
                        <form method="POST" action="{{ route('checkins.destroy', $checkIn->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <x-primary-button class="mx-2 text-center focus:outline-none text-white bg-red-700  focus:ring-4 focus:ring-red-300 dark:bg-red-600  dark:focus:ring-red-900 ">
                                <a href="#" class="text-white">{{ __('Delete') }}</a>
                            </x-primary-button>
                        </form>
                    </div>

                </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>