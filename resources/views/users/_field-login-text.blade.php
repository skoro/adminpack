<small class="form-text text-muted">
    @if (optional($user)->id == auth_admin()->id())
        {{ __('This field is used for your login.') }}
    @else
        {{ __('This field is used for user login.') }}
    @endif
</small>