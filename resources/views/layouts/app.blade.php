<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ env('VA_NAME') }} | foxsys-xyz</title>

        <!-- Styles -->
        <link 
            href="/css/app.css?id={{ Str::random(32) }}"
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

        </style>

        <!-- Icons -->
        <link 
            href="/icons/tabler-icons.min.css?id={{ Str::random(32) }}"
            rel="stylesheet"
            type="text/css"
        />

        <!-- Alpine JS -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    </head>

    <body class="font-mono">

        @yield('content')

    </body>
</html>
