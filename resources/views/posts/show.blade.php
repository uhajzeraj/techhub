<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }}</title>
</head>

<body>
    <ul>
        <li><a href="/">Homepage</a></li>
        <li><a href="{{ route('posts.index') }}">Posts</a></li>
    </ul>

    <h1>{{ $post->title }}</h1>

    <h3>Written by:
        <a href="{{ route('authors.show', $post->author->username) }}">
            {{ $post->author->name }}
        </a>
    </h3>

    <div style="margin-bottom: 2em;">
        {{ $post->excerpt }}
    </div>

    <article>
        {{ $post->content }}
    </article>

    <a href={{ route('posts.index') }}>
        <h4>Go back</h4>
    </a>
</body>

</html>
