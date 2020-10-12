<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ env('VA_NAME') }} | {{ env('APP_NAME') }}</title>

        <!-- foxsys-xyz Favicon -->
        <link rel="icon" type="image/png" href="/img/foxsys-xyz [Icon] [Light Back].png">

        <!-- Styles -->
        <link 
            href="{{ mix('/css/app.css') }}"
            rel="stylesheet"
            type="text/css"
        /> 

        <style>
        
            /* Hide scrollbar for Chrome, Safari and Opera */
            body::-webkit-scrollbar {
                display: none;
            }

            /* Hide scrollbar for IE and Edge */
            body {
                -ms-overflow-style: none;
            }
            
            /* Hide select formatting for Chrome and Edge */
            select {
                -o-appearance: none;
                -ms-appearance: none;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
            }

        </style>

        <!-- Icons -->
        <link 
            href="{{ mix('/icons/tabler-icons.min.css') }}"
            rel="stylesheet"
            type="text/css"
        />

        <!-- Alpine JS -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

        <!-- Custom JS -->
        <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>

    </head>

    <body class="font-mono">

        @yield('content')

    </body>
</html>
