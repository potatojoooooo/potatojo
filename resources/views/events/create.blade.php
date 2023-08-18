<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create event') }}
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
                    <form method="POST" action="{{ route('events.store') }}">
                        @csrf

                        <div>
                            <x-input-label :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                        </div>

                        <div>
                            <x-input-label class="mt-4" :value="__('Description')" />
                            <textarea name="description" rows="4" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" placeholder="Write event's description here..." required autofocus></textarea>
                        </div>

                        <div class="form-group">
                            <x-input-label class="mt-4" :value="__('Location')" />
                            <x-text-input class="block mt-1 w-full" type="text" name="location" id="location" required autofocus autocomplete="location" />
                        </div>

                        <div class="form-group">
                            <x-input-label class="mt-4" :value="__('Date')" />
                            <x-text-input class="block mt-1 w-full" type="date" name="date" required autofocus autocomplete="date" />
                        </div>

                        <div class="form-group">
                            <x-input-label class="mt-4" :value="__('Start time')" />
                            <x-text-input class="block mt-1 w-full" type="time" name="start_time" required autofocus autocomplete="time" />
                        </div>

                        <div class="form-group">
                            <x-input-label class="mt-4" for="end_time" :value="__('End time')" />
                            <x-text-input class="block mt-1 w-full" type="time" name="end_time" required autofocus autocomplete="time" />
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create event') }}
                            </x-primary-button>
                        </div>
                        <input type="text" id="lat" name="lat">
                        <input type="text" id="long" name="long">
                        <input type="text" id="ip" name="ip">
                        <!-- change to type="hidden" -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACqi-a5Hr_6Wcf2UhrVAhYqPTwYD2hTvM&libraries=places"></script>
    <script>
        $(document).ready(function() {
            var autocomplete;
            var to = 'location';
            autocomplete = new google.maps.places.Autocomplete((document.getElementById(to)), {
                types: ['geocode'],
            });

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var near_place = autocomplete.getPlace();
                jQuery("#lat").val(near_place.geometry.location.lat());
                jQuery("#long").val(near_place.geometry.location.lng());

                $.getJSON("https://api.ipify.org/?format=json", function(data){
                    let ip = data.ip;
                    jQuery("#ip").val(ip);
                });
            });
        });
    </script>
</x-app-layout>