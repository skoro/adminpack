<div {{ $attributes->merge(['class' => 'form-group row']) }}>
    
    <label class="col-sm-2 col-form-label">
        @empty($custom_label)
            {{ $label }}
        @else
            {{ $custom_label }}
        @endempty
    </label>

    <div class="col-sm-10 form-row-slot">
        {{ $slot }}
        @if (!empty($error))
            @error($error)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        @endif
    </div>

</div>