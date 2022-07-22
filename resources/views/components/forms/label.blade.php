
<!-- Application Input Label -->

    <span 
        {{ $attributes->merge(['class' => '
            text-xs flex items-center
        ']) }}
    >
        {{ $slot }} {{ $for }}
    </span>

<!-- Application Input Label End -->
