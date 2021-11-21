
<!-- Application Input Label -->

    <span 
        {{ $attributes->merge(['class' => '
            text-sm flex items-center
        ']) }}
    >
        {{ $slot }} {{ $for }}
    </span>

<!-- Application Input Label End -->
