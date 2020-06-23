<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset(mix('app.css', 'vendor/adminpack')) }}" rel="stylesheet" type="text/css">
</head>

<body class="bg-primary">
  
  <div id="layoutAuthentication">
    
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            @yield('content')
          </div>
        </div>
      </main>
    </div> <!-- /#layoutAuthentication_content -->

    <div id="layoutAuthentication_footer">
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
              Copyright &copy; Your Website 2020
            </div>
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div> <!-- /#layoutAuthentication_footer -->

  </div> <!-- /#layoutAuthentication -->

  <script src="{{ asset(mix('app.js', 'vendor/adminpack')) }}"></script>

</body>
