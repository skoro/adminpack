@php
/**
 * @param int $defaultRole The default role ID for user registration.
 */
$defaultRole = option('user_default_role');
@endphp
@extends('admin::layouts.admin')

@section('title', __('Roles'))

@section('content')
    <p>
        <x-admin-button icon="plus" type="toolbar" :url="route('admin.role.create')">
            {{ __('New Role') }}
        </x-admin-button>
    </p>
    <table class="table table-sm">
        <thead class="thead-light">
            <tr>
                <th>{{ __('Role') }}</th>
                <th>{{ __('Permissions') }}</th>
                <th>{{ __('Users') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach (roles() as $role)
                <tr>
                    <td>
                        <a href="{{ route('admin.role.edit', $role) }}" class="text-decoration-none">
                            {{ $role->name }}
                        </a>
                        @if ($defaultRole == $role->id)
                            <x-admin-icon
                                id="defaultRole"
                                icon="star"
                                class="text-warning"
                                data-toggle="popover"
                                data-placement="right"
                                data-content="{{ __('Default role for the registration.') }}"
                            >
                            </x-admin-icon>
                            @push('js')
                                $('#defaultRole').popover();
                            @endpush
                        @endif
                    </td>
                    <td>
                        <ul class="list-unstyled">
                        @foreach ($role->permissions as $permission)
                            <li>
                                <span class="badge badge-secondary">{{ $permission->scope }}</span>
                                <span class="text-muted">{{ $permission->name }}</span>
                            </li>
                        @endforeach
                        </ul>
                    </td>
                    <td>
                        <span class="badge badge-dark">
                            {{ $role->users()->count() }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
