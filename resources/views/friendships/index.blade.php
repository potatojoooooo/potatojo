<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/datepicker.min.js"></script>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Friend requests') }}
            </h2>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
</x-app-layout>