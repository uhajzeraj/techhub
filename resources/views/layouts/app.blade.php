<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', config('app.name'))</title>
    @yield('meta-tags')
</head>

<body>
    <ul>
        <li><a href="/">Homepage</a></li>
        <li><a href="{{ route('posts.index') }}">Posts</a></li>
    </ul>

    @yield('content')

    @include('components._flash-message')
</body>

</html>
