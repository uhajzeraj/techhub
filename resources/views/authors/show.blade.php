<x-layouts.app>
    <x-slot:title>{{ $author->name . ' - ' . config('app.name') }}</x-slot:title>
    <h1>{{ $author->name }}</h1>

    <h2>Posts:</h2>
    @foreach ($author->posts as $post)
        <a href="{{ route('posts.show', $post->slug) }}">
            <h3>{{ $post->title }}</h3>
        </a>
        <article>{{ $post->excerpt }}</article>
    @endforeach
</x-layouts.app>
