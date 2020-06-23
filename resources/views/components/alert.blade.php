<div class="alert alert-{{ $mapTypeToCss() }} @if ($close) alert-dismissible fade show @endif" role="alert">
    {{ $slot }}
    @if ($close)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    @endif
</div>