<a href="{{ route('posts.show', $post->slug) }}">
    <h3>{{ $post->title }}</h3>
</a>
<a href="{{ route('authors.show', $post->author->username) }}">
    <h4>Written by: {{ $post->author->name }}</h4>
</a>
<article>{{ $post->excerpt }}</article>

@once
    @push('scripts')
        <script>
            console.log('this got executed')
        </script>
    @endpush
@endonce
