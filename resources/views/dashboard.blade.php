<x-app-layout>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Step 1: Get user's IP address using ipify API
            $.getJSON("https://api.ipify.org/?format=json", function(data) {
                let ip = data.ip;

                // Step 2: Use IP geolocation service to get coordinates based on IP address
                var req = new XMLHttpRequest();
                req.open("GET", "http://ip-api.com/json/" + ip, true);
                req.send();
                req.onreadystatechange = function() {
                    if (req.readyState == 4 && req.status == 200) {
                        var obj = JSON.parse(req.responseText);
                        console.log(obj);

                        $.ajax({
                            type: "POST",
                            url: "/store-coordinates", // Replace with your Laravel route URL
                            data: {
                                longitude: obj.lon,
                                latitude: obj.lat
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log("Coordinates stored successfully:", response);
                            },
                            error: function(xhr, status, error) {
                                console.error("Error storing coordinates:", error);
                            }
                        });
                    }
                }
            });
        });

        function acceptFriendRequest(userId) {
            axios.post('/accept-friend-request', {
                    user_id: userId
                })
                .then(function(response) {
                    // Display a success alert
                    alert(response.data.message);
                    location.reload();
                    // You can also update the UI or take other actions if needed
                })
                .catch(function(error) {
                    // Handle errors
                });
        }
    </script>
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
                    <p class="py-3">Enable location sharing to let others know you're in the same area?</p>
                    <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">
                        <a href="">{{ __('Yes') }}</a>
                    </button>
                    <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        <a href="" class="text-white">{{ __('No') }}</a>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent check-ins -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between"> <!-- Use flex-col to stack items vertically -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pb-2 pl-2">Recent check-ins</h2>
            <a href="#" class="underline text-lg text-gray-800 dark:text-gray-200 leading-tight pb-2 pl-2 mt-auto">view all</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($checkIns as $checkIn)
            <div class="w-full my-4 max-w-sm bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex px-4 pt-4">
                </div>
                <div class="flex flex-col items-center pb-10">
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $checkIn->location }}</h5>
                    <span class="text-ellipsis overflow-hidden mx-10 text-sm text-gray-500 dark:text-gray-400">{{ $checkIn->check_in_notes }}</span>
                    <span class="text-ellipsis overflow-hidden mx-10 text-sm text-gray-500 dark:text-gray-400">Visited on {{ $checkIn->created_at }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Friend requests -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pb-2 pl-2">Friend requests</h2>
            <a href="#" class="underline text-lg text-gray-800 dark:text-gray-200 leading-tight pb-2 pl-2 mt-auto">view all</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($friendRequests as $request)
            <div class="w-full my-4 max-w-sm bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex px-4 pt-4">
                </div>
                <div class="flex flex-col items-center pb-10">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset('image/default-picture.jpg') }}" alt="{{ $request->name }} image" />
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $request->name }}</h5>
                    <span class="text-ellipsis overflow-hidden mx-10 text-sm text-gray-500 dark:text-gray-400">{{ $request->bio }}</span>
                    <div class="flex mt-4 space-x-3 md:mt-6">
                        <a href="#" onclick="acceptFriendRequest( '{{ $request->id }}' );" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add friend</a>
                        <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">Message</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- <div class="py-4">
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
        </div>
    </div> -->
</x-app-layout>