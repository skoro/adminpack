@php
/**
 * @param \Skoro\AdminPack\Models\Role|null $role
 */
@endphp

<x-admin-form-row :label="__('Role Name')" error="name">
    <input
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', optional($role)->name) }}"
        required
        autofocus
    >
</x-admin-form-row>

<h4>{{ __('Permissions') }}</h4>

@error('permission')
    <x-admin-alert type="error">
        {{ $message }}
    </x-admin-alert>
@enderror

@foreach (scope_permissions() as $scope => $permissions)
    <x-admin-form-row>

        <x-slot name="custom_label">
            <span class="badge badge-secondary">{{ $scope }}</span>
        </x-slot>

        @foreach ($permissions as $permission)
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-check">
                        <input
                            id="perm{{ $permission->id }}"
                            type="checkbox"
                            name="permission[{{ $permission->id }}]"
                            class="form-check-input"
                            @if (!$errors->has('permission') && isset($role) && $role->permissions->find($permission->id)) checked @endif
                            value="{{ $permission->id }}"
                        >
                        <label for="perm{{ $permission->id }}" class="form-check-label">
                            {{ $permission->name }}
                        </label>
                    </div>
                </div>
            </div>
        @endforeach

    </x-admin-form-row>
@endforeach