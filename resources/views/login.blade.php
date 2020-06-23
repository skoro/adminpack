@extends('admin::layouts.auth')

@section('content')
<div class="view-login col-lg-5">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        
        <div class="card-header">
            <h3 class="text-center font-weight-light my-4">
                {{ __('Login') }}
            </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                
                <div class="form-group">
                    <label class="small mb-1" for="inputEmailAddress">
                        {{ __('E-Mail Address') }}
                    </label>
                    <input
                        id="inputEmailAddress"
                        type="email"
                        class="form-control py-4 @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        placeholder="{{ __('Enter email address') }}"
                        autofocus
                    >
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="small mb-1" for="inputPassword">
                        {{ __('Password') }}
                    </label>
                    <input
                        id="inputPassword"
                        type="password"
                        class="form-control py-4 @error('password') is-invalid @enderror"
                        name="password"
                        placeholder="{{ __('Enter password') }}"
                        required
                        autocomplete="current-password"
                    >
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input id="rememberPasswordCheck" class="custom-control-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="rememberPasswordCheck">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                    @if (Route::has('password.request'))
                        <a class="small" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    <x-admin-button type="submit">
                        {{ __('Login') }}
                    </x-admin-button>
                </div>

            </form>
        </div> <!-- /.card-body -->

    </div>
</div> <!-- /.view-login -->
@endsection
