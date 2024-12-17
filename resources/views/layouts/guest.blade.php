<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Guest Layout' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Adjust paths for Vite --}}
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col justify-center items-center">
        {{--  {{ $slot }}  --}}
                @yield('content')

    </div>
</body>
</html>
