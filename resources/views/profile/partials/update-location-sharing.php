<section>
    <header>
        <style>
            .switch {
                position: relative;
                display: inline-block;
                width: 60px;
                height: 34px;
            }

            .switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }

            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }

            input:checked+.slider {
                background-color: #2196F3;
            }

            input:focus+.slider {
                box-shadow: 0 0 1px #2196F3;
            }

            input:checked+.slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
            }

            /* Rounded sliders */
            .slider.round {
                border-radius: 34px;
            }

            .slider.round:before {
                border-radius: 50%;
            }
        </style>
        <script>
            $(document).ready(function() {
                $('#allowSharingLocation').on('change', function() {
                    var newValue = $(this).is(':checked') ? 1 : 0;

                    // Send the new value to the server using AJAX
                    $.ajax({
                        type: 'POST',
                        url: '/update-location-sharing', // Replace with your route URL
                        data: {
                            _token: '{{ csrf_token() }}',
                            newValue: newValue
                        },
                        success: function(response) {
                            // Update the switch based on the response
                            if (newValue === 1) {
                                $('#allowSharingLocation').prop('checked', true);
                            } else {
                                $('#allowSharingLocation').prop('checked', false);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error updating location sharing:', error);
                        }
                    });
                });
            });
        </script>

        <input type="text" id="allowSharingLocation" >
        
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Location sharing
            {{ auth()->user()->allow_location_sharing }} 
            {{ Auth::user()->email }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Update location sharing to determine how other users view you.
        </p>
        <!-- Toggle button -->
        <label class="switch mt-2 text-sm text-gray-600 dark:text-gray-400">
            <input type="checkbox" {{ $allowSharingLocation == 0 ? 'checked' : '' }}>
            <span class="slider round"></span>
        </label>
    </header>
</section>