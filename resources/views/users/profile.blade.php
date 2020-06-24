@php
/**
 * @param \App\User $user
 */
$user = auth()->user();
@endphp

@extends('layouts.admin')

@section('title', __('Profile'))
@section('subTitle', $user->name)

@section('content')
    <form action="{{ route('admin.user.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.users._edit-form')

        <x-form-actions>
        </x-form-actions>
        
    </form>
@endsection