
<!-- Application Primary Button -->

<button 
    {{ $attributes->merge(['class' => '
        justify-center w-full lg:w-auto flex items-center focus:outline-none px-4 py-1.5 rounded-full
        focus:shadow-outline bg-blue-600 hover:bg-blue-700 transition duration-150
    ']) }}
>
    {{ $slot }}
</button>

<!-- Application Primary Button End -->
