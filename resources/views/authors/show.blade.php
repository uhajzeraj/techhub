<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $author->name . ' - ' . config('app.name') }}</title>
</head>

<body>
    <ul>
        <li><a href="/">Homepage</a></li>
        <li><a href="{{ route('posts.index') }}">Posts</a></li>
    </ul>

    <h1>{{ $author->name }}</h1>

    <h2>Posts:</h2>
    @foreach ($author->posts as $post)
        <a href="{{ route('posts.show', $post->slug) }}">
            <h3>{{ $post->title }}</h3>
        </a>
        <article>{{ $post->excerpt }}</article>
    @endforeach
</body>

</html>
