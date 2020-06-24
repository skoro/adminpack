@php
/**
 * @param \Skoro\AdminPack\Models\User|null $user
 * @param int $defaultRole The default role for new users.
 */
$defaultRole = option('user_default_role');
@endphp

<x-admin-form-row :label="__('Name')" error="name">
    <input 
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', optional($user)->name) }}"
        required
        autofocus
    >
</x-admin-form-row>

<x-admin-form-row :label="__('Email')" error="email">
    <input
        type="email"
        name="email"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', optional($user)->email) }}"
        required
    >
</x-admin-form-row>

<x-admin-form-row :label="__('Role')" error="role">
    <select name="role" class="custom-select">
        @foreach (roles() as $role)
            @if (empty($user))
                <option value="{{ $role->id }}" @if (old('role', $defaultRole) == $role->id) selected @endif>
            @else
                <option value="{{ $role->id }}" @if (old('role', optional($user)->role_id) == $role->id) selected @endif>
            @endif
                    {{ $role->name }}
                </option>
        @endforeach
    </select>
</x-admin-form-row>

<x-admin-form-row :label="__('Password')">
    <div class="row">
        <div class="col-sm-6">
            <input
                type="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="{{ __('New password') }}"
                autocomplete="new-password"
                @empty(optional($user)->id) required @endif
            >
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-sm-6">
            <input
                type="password"
                name="password_confirmation"
                class="form-control"
                placeholder="{{ __('Confirm password') }}"
                autocomplete="new-password"
                @empty(optional($user)->id) required @endif
            >
        </div>
    </div>
</x-admin-form-row>

<x-admin-form-row :label="__('Status')">
    <div class="custom-control custom-switch">
        <input
            id="userStatus"
            type="checkbox"
            name="status"
            class="custom-control-input"
            @if (old('status', optional($user)->isActive())) checked @endif
            value="{{ \Skoro\AdminPack\Models\User::STATUS_ACTIVE }}"
        >
        <label for="userStatus" class="custom-control-label">
            {{ __('Active') }}
        </label>
    </div>
</x-admin-form-row>
