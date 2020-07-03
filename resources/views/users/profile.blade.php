@php
/**
 * @param \Skoro\AdminPack\Models\User $user
 */
$user = auth_admin()->user();
@endphp

@extends('admin::layouts.admin')

@section('title', __('Profile'))
@section('subTitle', $user->name)

@section('content')
    <form action="{{ route('admin.user.updateProfile', $user) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin::users._edit-form', [
            'hide' => ['role', 'status'],
        ])

        <x-admin-form-actions/>
        
    </form>
@endsection