<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mr-4" style="display: inline-flex;">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-gray-900 dark:text-gray-100">Events</h1>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img src="" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">name</h5>
                                    <p class="card-text">desc</p>
                                    <a href="" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="display: inline-flex;">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-gray-900 dark:text-gray-100">Events</h1>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img src="" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">name</h5>
                                    <p class="card-text">desc</p>
                                    <a href="" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>