<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Geolocation Social Website') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/getCoordinates.js', 'resources/js/geolocation.js', 'resources/js/eventParticipation.js', 'resources/js/eventCategories.js', 'resources/js/eventDurations.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACqi-a5Hr_6Wcf2UhrVAhYqPTwYD2hTvM&libraries=places"></script>
    <script>
        
    </script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>