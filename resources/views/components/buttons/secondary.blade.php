
<!-- Application Secondary Button -->

<button 
    {{ $attributes->merge(['class' => '
        justify-center w-full lg:w-auto flex items-center focus:outline-none px-4 py-1.5 rounded-full
        focus:shadow-outline bg-gray-500 hover:bg-gray-600 transition duration-150
    ']) }}
>
    {{ $slot }}
</button>

<!-- Application Secondary Button End -->
