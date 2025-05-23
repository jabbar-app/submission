<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Future Leaders ID | Leadership Project Submission</title>

  {{-- Import Google Fonts Plus Jakarta Sans --}}
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">

  {{-- Vite Assets --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- Custom Font Tailwind --}}
  <style>
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
  </style>
</head>

<body class="antialiased bg-gray-100 text-gray-900">
  <div class="min-h-screen flex flex-col items-center justify-center p-4">
    @yield('content')
  </div>
</body>

</html>
