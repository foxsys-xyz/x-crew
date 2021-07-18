<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.va_name') }} // {{ config('app.name') }}</title>

        <!-- foxsys-xyz Favicon -->
        <link rel="icon" type="image/png" href="/img/Logo [Dark Background].svg">

        <!-- JS -->
        <script src="{{ mix('/js/app.js') }}"></script>

        <!-- Lealet Maps -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

        <!-- Styles -->
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" type="text/css" />

        <!-- Icons -->
        <link href="{{ mix('/icons/tabler-icons.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body class="font-mono">
        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-black text-white">

            @include('layouts.cloud.sidebar')

            <div class="flex-1 flex flex-col overflow-hidden">
                <div class="bg-gray-900 bg-opacity-80 overflow-y-auto">

                    @include('layouts.cloud.header')

                    <main class="flex-1 overflow-x-hidden bg-black rounded-tl-3xl rounded-bl-3xl min-h-screen">

                        @yield('content')
                    
                    </main>
                
                    @include('layouts.cloud.footer')

                </div>
            </div>
        </div>
    </body>
</html>
