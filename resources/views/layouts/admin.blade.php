<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Administry') }} - @yield('title')</title>

    <link href="{{ asset(mix('app.css', 'vendor/admin')) }}" rel="stylesheet" type="text/css" />
</head>

<body class="sb-nav-fixed">
    
    @include('admin::partials.navbar')
    @include('admin::partials.sidebar')

    <div id="layoutSidenav_content" class="main-content">

        <main id="admin">

            <div class="container-fluid">

                @includeWhen(session()->has('toasts'), 'admin::partials.toast')

                <h1 class="mt-4">
                    @yield('title')
                    @hasSection ('subTitle')
                        <small class="text-muted">@yield('subTitle')</small>
                    @endif
                </h1>

                @foreach (session()->get('alerts', []) as $alert)
                    <x-admin-alert :type="$alert['type']" :close="$alert['close']">
                        {{ $alert['message'] }}
                    </x-admin-alert>
                @endforeach

                <ol class="breadcrumb mb-4">
                    @section('breadcrumbs')
                    @show
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>

                @yield('content')

            </div>
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                @section('footer')
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2019</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                @show
            </div>
        </footer>

    </div> <!-- /.layoutSidenav_content -->

    <script src="{{ asset(mix('app.js', 'vendor/admin')) }}"></script>
    <script>
        jQuery(document).ready(function ($) {
            @stack('js')
        });
    </script>
</body>

</html>