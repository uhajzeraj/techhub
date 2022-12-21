<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }}</title>
</head>

<body>
    <h1>Hello world 👋🏻</h1>

    @foreach ($posts as $post)
        <a href="{{ route('posts.show', $post->slug) }}">
            <h3>{{ $post->title }}</h3>
        </a>
        <article>{{ $post->excerpt }}</article>
    @endforeach
</body>

</html>
