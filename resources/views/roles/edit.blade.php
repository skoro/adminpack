@php
/**
 * @param \Skoro\AdminPack\Models\Role $role The role.
 * @param bool $canDelete  Can the role be deleted?
 */
@endphp

@extends('admin::layouts.admin')

@section('title', __('Role'))
@section('subTitle', $role->name)

@section('content')
    <form action="{{ route('admin.role.update', $role) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin::roles._edit-form')

        <x-admin-form-actions :back-url="route('admin.roles')">
            <x-slot name="secondary">
                @if ($canDelete)
                    <x-admin-delete-model :title="__('Delete Role ?')" :action="route('admin.role.delete', $role)">
                        <p>
                            {{ __('Are you sure you want to delete role:')}}
                        </p>
                        <strong>{{ $role->name }}</strong>
                    </x-admin-delete-model>
                @else
                    <button
                        type="button"
                        class="btn btn-danger"
                        data-toggle="popover"
                        data-container="body"
                        data-placement="left"
                        data-content="{{ __('This role belongs to users and cannot be deleted.') }}"
                    >
                        {{ __('Delete') }}
                    </button>
                    @push('js')
                        $('[data-toggle="popover"]').popover();
                    @endpush
                @endif
            </x-slot>
        </x-admin-form-actions>

    </form>
@endsection