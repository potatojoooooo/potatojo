<x-app-layout>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Step 1: Get user's IP address using ipify API
            $.getJSON("https://api.ipify.org/?format=json", function(data) {
                let ip = data.ip;
                console.log(ip);
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
                                latitude: obj.lat,
                                city: obj.city
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

        function deleteFriendRequest(userId) {
            axios.delete('/delete-friend-request', {
                    data: {
                        user_id: userId
                    } // Pass the data object
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
    @if (auth()->user()->role != 2)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (auth()->user()->allow_location_sharing == 0)
                    {{ __("You're logged in!") }}
                    <p class="py-3">Enable location sharing to let others know you're in the same area? Head to Profile.</p>
                    @else
                    {{ __("You're logged in!") }}
                    <p class="py-3">Location sharing is already enabled.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent check-ins -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-8">
        <div class="flex justify-between"> <!-- Use flex-col to stack items vertically -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pb-2 pl-2">Your recent check-ins</h2>
            <a href="{{ route('checkins.index')}}" class="underline text-lg text-gray-800 dark:text-gray-200 leading-tight pb-2 pl-2 mt-auto">view all</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($checkIns as $checkIn)
            <div class="w-full my-4 max-w-sm bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex px-4 pt-4">
                </div>
                <div class="flex flex-col items-center p-5 text-center pt-3">
                    <h5 class="overflow-hidden mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $checkIn->location }}</h5>
                    <span class="text-ellipsis overflow-hidden mx-10 text-sm text-gray-500 dark:text-gray-400">{{ $checkIn->check_in_notes }}</span>
                    <span class="text-ellipsis overflow-hidden mx-10 text-sm text-gray-500 dark:text-gray-400">Visited on {{ $checkIn->created_at }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Friends' recent check-ins -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-8">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pb-2 pl-2">Friends' recent check-ins</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($friendsCheckIns as $friendsCheckIn)
            <div class="w-full my-4 max-w-sm bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-6">
                <div class="flex flex-col items-center">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ $friendsCheckIn['imagePath'] ?? 'image/default-picture.jpg' }}" alt="{{ $friendsCheckIn['name'] }} image" />
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $friendsCheckIn['name'] }}</h5>
                    <div class="flex flex-col items-center pb-2">
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $friendsCheckIn['location'] }}</h5>
                        <span class="text-ellipsis overflow-hidden mx-10 text-sm text-gray-500 dark:text-gray-400">{{ $friendsCheckIn['check_in_notes'] }}</span>
                        <span class="text-ellipsis overflow-hidden mx-10 text-sm text-gray-500 dark:text-gray-400">Visited on {{ $friendsCheckIn['created_at'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>



    <!-- Friend requests -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-8">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pb-2 pl-2">Friend requests</h2>
            <a href="{{ route('friendships.index')}}" class="underline text-lg text-gray-800 dark:text-gray-200 leading-tight pb-2 pl-2 mt-auto">view all</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($friendRequests as $request)

            <div class="w-full my-4 max-w-sm bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-6">
                <a href="{{ route('users.show', $request->id)}}" class="flex flex-col items-center ">
                    <div class="flex flex-col items-center">
                        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset($request->user_image ?? 'image/default-picture.jpg') }}" alt="{{ $request->name }} image" />
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $request->name }}</h5>
                        <p class="text-center overflow-hidden truncate w-80 mx-10 text-sm text-gray-500 dark:text-gray-400">{{ $request->bio }}</p>
                        <div class="flex mt-4 space-x-3 md:mt-6">
                            <a href="#" onclick="acceptFriendRequest( '{{ $request->id }}' );" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Accept</a>

                            <a href="#" onclick="deleteFriendRequest( '{{ $request->id }}' );" class="text-white inline-flex items-center px-4 py-2 text-sm font-medium text-center bg-white rounded-lg bg-red-700  focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:focus:ring-red-900">Delete</a>
                        </div>
                    </div>
                </a>
            </div>

            @endforeach
        </div>
    </div>
    @else
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Welcome, admin!
                </div>
            </div>
        </div>
    </div>
    @endif

</x-app-layout>