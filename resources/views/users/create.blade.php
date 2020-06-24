@extends('admin::layouts.admin')

@section('title', __('New User'))

@section('content')
    <form action="{{ route('admin.user.create') }}" method="POST">
        @csrf
        @include('admin::users._edit-form', [
            'user' => null,
        ])

        <x-admin-form-actions :back-url="route('admin.users')">
        </x-admin-form-actions>

    </form>
@endsection
