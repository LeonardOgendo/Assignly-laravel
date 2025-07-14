<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>{{ config('app.name', 'Task Manager') }}</title>

    <!-- CSRF Token-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind + Vue (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#222] antialiased">
    @yield('content')
</body>
</html>
