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

        <!-- Styles -->
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" type="text/css" />

        <!-- Icons -->
        <link href="{{ mix('/icons/tabler-icons.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body class="font-mono tracking-wider">

        @yield('content')

        <script>
            Alpine.start();
        </script>
    </body>
</html>
