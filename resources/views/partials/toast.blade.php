<div aria-live="polite" aria-atomic="true" class="position-relative">
    <div style="position: absolute; top: 0; right: 0; z-index: 1">

        @foreach (session()->get('toasts') as $toast)
            <div
                class="toast toast-{{ $loop->iteration }}"
                @if ($toast['autohide']) data-delay="4500" @else data-autohide="false" @endif
                role="alert"
                aria-live="assertive"
                aria-atomic="true"
            >
                <div class="toast-header">
                    <x-admin-icon icon="info-circle" class="mr-2"></x-admin-icon>
                    <strong class="mr-auto">
                        {{ __('Info') }}
                    </strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    {{ $toast['message'] }}
                </div>
            </div>
            @push('js')
                $('.toast-{{ $loop->iteration }}').toast('show');
            @endpush
        @endforeach

    </div>
</div>
