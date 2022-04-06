<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <div class="app">
    <main class="py-4">
      @yield('content')
    </main>
  </div>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>