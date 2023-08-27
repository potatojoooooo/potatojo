<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("friends list and check ins") }}
                </div>

            </div>
        </div>
    </div>

    <!-- Nearby users -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pb-2 pl-2">Nearby users</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($nearbyUsers as $request)
            <div class="w-full my-4 max-w-sm bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex px-4 pt-4">
                </div>
                <div class="flex flex-col items-center pb-10">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset('image/default-picture.jpg') }}" alt="{{ $request->name }} image" />
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $request->name }}</h5>
                    <span class="text-ellipsis overflow-hidden mx-10 text-sm text-gray-500 dark:text-gray-400">{{ $request->bio }}</span>
                    <div class="flex mt-4 space-x-3 md:mt-6">
                        <x-primary-button class="text-center">
                            <a href="{{ route('users.show', $request->id)}}">{{ __('View details') }}</a>
                        </x-primary-button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</x-app-layout>