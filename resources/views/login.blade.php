<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset(mix('app.css', 'vendor/admin')) }}" rel="stylesheet" type="text/css">
    <link href="{{ asset(mix('login.css', 'vendor/admin')) }}" rel="stylesheet" type="text/css">
</head>

<body class="text-center">
    <form class="form-signin" method="POST" action="{{ route('admin.login') }}">
        @csrf

        <svg width="72" height="72" viewBox="0 0 16 16" class="mb-4 bi bi-lock" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1zm-7-1a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-7zm0-3a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>
        </svg>

        <h1 class="h3 mb-3 font-weight-normal">
            {{ __('Admin Login') }}
        </h1>
        
        <label for="inputEmail" class="sr-only">
            {{ __('Email') }}
        </label>

        <input
            type="email"
            id="inputEmail"
            class="form-control @error('email') is-invalid @enderror"
            placeholder="{{ __('Email') }}"
            name="email"
            value="{{ old('email') }}"
            autocomplete="email"
            required
            autofocus
        >
        
        <label for="inputPassword" class="sr-only">
            {{ __('Password') }}
        </label>
        
        <input
            type="password"
            id="inputPassword"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="{{ __('Password') }}"
            name="password"
            required
            autocomplete="current-password"
        >
        
        <div class="checkbox mb-3">
        <label>
            <input
                type="checkbox"
                name="remember"
                {{ old('remember') ? 'checked' : '' }}
            > {{ __('Remember Me') }}
        </label>
        </div>
        
        <x-admin-button type="submit" class="btn-lg btn-block">
            {{ __('Login') }}
        </x-admin-button>
        
        <p class="mt-5 mb-3 text-muted">&copy; {{ date('Y') }}</p>
    </form>
</body>