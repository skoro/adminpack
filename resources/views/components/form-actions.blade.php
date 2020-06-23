<div {{ $attributes->merge(['class' => 'form-actions form-group row']) }}>
    <div class="form-actions-main col-sm-10">
        @if ($submit !== false)
            <x-admin-button type="submit">{{ $submit }}</x-admin-button>
        @endif
        @if (!empty($backUrl))
            <x-admin-button :url="$backUrl">
                {{ __('Back') }}
            </x-admin-button>
        @endif
        {{ $slot }}
    </div>
    @if (!empty($secondary))
    <div class="form-actions-secondary col-sm-2 text-right">
        {{ $secondary }}
    </div>
    @endif
</div>
