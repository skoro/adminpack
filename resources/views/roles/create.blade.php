@extends('admin::layouts.admin')

@section('title', __('New Role'))

@section('content')
    <form action="{{ route('admin.role.store') }}" method="POST">
        @csrf

        @include('admin::roles._edit-form', [
            'role' => null,
        ])

        <x-admin-form-actions :back-url="route('admin.roles')"/>

    </form>
@endsection