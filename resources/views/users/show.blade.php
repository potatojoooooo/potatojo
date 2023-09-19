<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            User details
        </h2>
    </x-slot>
    <div style="overflow-wrap: break-word; word-wrap: break-word; word-break: break-word;" class="max-w-3xl mx-auto sm:px-6 lg:px-8 py-12 text-center ">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="display: inline-flex;">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="row ">
                    <div class="col-md-4">
                        <div class="m-3 text-gray-900 dark:text-gray-100 text-center">
                            <img class="p-2 w-36 h-36 mb-3 mx-auto rounded-full shadow-lg" src="{{ $imagePath ?? 'image/default-picture.jpg' }}" alt="User Image">
                        </div>

                        <div class="m-3 text-gray-900 dark:text-gray-100">
                            {{$user -> name}}
                        </div>

                        @if($user -> allow_location_sharing == 1)
                        <div class="m-3 text-gray-900 dark:text-gray-100 inline-flex">
                            <div>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 21">
                                    <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <path d="M8 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        <path d="M13.8 12.938h-.01a7 7 0 1 0-11.465.144h-.016l.141.17c.1.128.2.252.3.372L8 20l5.13-6.248c.193-.209.373-.429.54-.66l.13-.154Z" />
                                    </g>
                                </svg>
                            </div>
                            <div class="ml-2">
                                {{$user -> city}}
                            </div>

                        </div>
                        @endif

                        <div class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                            {{$user -> bio}}
                        </div>

                        <div class="mt-6 mb-6 text-gray-900 dark:text-gray-100">
                            @foreach($interests as $interest)
                            <div class="inline-flex items-center px-4 py-2 dark:bg-violet-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-violet-950  ">{{$interest -> name}}</div>
                            @endforeach
                        </div>
                        @if($friendshipStatus == 2)
                        <div class="pt-4">
                            <a href="#" onclick="deleteFriend( '{{ $user->id }}' );" class="text-white inline-flex items-center px-4 py-2 text-sm font-medium text-center bg-white rounded-lg bg-red-700  focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:focus:ring-red-900">Delete friend</a>
                        </div>
                        @elseif($friendshipStatus == 1)
                        <div class="pt-4">
                            <a href="#" onclick="acceptFriendRequest( '{{ $user->id }}' );" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Accept friend</a>
                        </div>
                        @elseif($friendshipStatus == 3)
                        <div class="pt-4">
                            <a href="#"  class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Friendship pending</a>
                        </div>
                        @else
                        <div class="pt-4">
                            <a href="#" onclick="addFriend( '{{ $user->id }}' );" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add friend</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function deleteFriend(userId) {
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

            function addFriend(userId) {
                axios.post('/add-friend', {
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
</x-app-layout>