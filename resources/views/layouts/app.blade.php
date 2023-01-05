<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', config('app.name'))</title>
    @yield('meta-tags')

    @stack('scripts')
    @vite('resources/css/app.css')
    @stack('stylesheets')
</head>

<body>
    <ul>
        <li><a href="/">Homepage</a></li>
        <li><a href="{{ route('posts.index') }}">Posts</a></li>
    </ul>

    @yield('content')

    <x-flash-message />
</body>

</html>
