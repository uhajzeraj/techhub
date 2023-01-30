<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? config('app.name') }}</title>

    @stack('scripts')
    @stack('stylesheets')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-gray-900 h-full">
    <x-layouts.navbar></x-layouts.navbar>

    {{ $slot }}

    <x-flash-message />

    <x-layouts.newsletter />
</body>

</html>
