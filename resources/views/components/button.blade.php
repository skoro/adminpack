<{{ $tag }}
    @if ($isSubmit) type="submit" @endif
    @if ($href) href="{{ $href }}" @endif
    {{ $attributes->merge(['class' => $classes]) }}
>
    @if ($icon)
        <x-admin-icon :icon="$icon"/>
    @endif
    {{ $slot }}
</{{ $tag }}>
