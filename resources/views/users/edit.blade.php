@php
/**
 * @param \Skoro\AdminPack\Models\User $user
 */
@endphp

@extends('admin::layouts.admin')

@section('title', __('User'))
@section('subTitle', $user->name)

@section('content')
    <form action="{{ route('admin.user.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        
        @include('admin::users._edit-form')

        <x-admin-form-actions :back-url="route('admin.users')">

            @if (auth_admin()->user()->can('delete', $user) && auth_admin()->id() != $user->id)
                <x-slot name="secondary">
                    <x-admin-delete-model :title="__('Delete User ?')" :action="route('admin.user.delete', $user)">
                        <p>{{ __('Are you sure you want to delete user:') }}</p>
                        <strong>{{ $user->name }}</strong>
                        <div>
                            <span class="badge badge-info">{{ $user->role->name }}</span>
                        </div>
                    </x-admin-delete-model>
                </x-slot>
            @endif

        </x-admin-form-actions>

    </form>
@endsection