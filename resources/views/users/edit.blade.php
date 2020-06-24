@php
/**
 * @param \App\User $user
 */
@endphp

@extends('layouts.admin')

@section('title', __('User'))
@section('subTitle', $user->name)

@section('content')
    <form action="{{ route('admin.user.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        
        @include('admin.users._edit-form')

        <x-form-actions :back-url="route('admin.users')">

            @if (Auth::user()->can('delete', $user) && Auth::user()->id != $user->id)
                <x-slot name="secondary">
                    <x-delete-model :title="__('Delete User ?')" :action="route('admin.user.delete', $user)">
                        <p>{{ __('Are you sure you want to delete user:') }}</p>
                        <strong>{{ $user->name }}</strong>
                        <div>
                            <span class="badge badge-info">{{ $user->role->name }}</span>
                        </div>
                    </x-delete-model>
                </x-slot>
            @endif

        </x-form-actions>

    </form>
@endsection