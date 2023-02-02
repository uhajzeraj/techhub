<x-mail::message>
# New post added

Your post with title **{{ $post->title }}** was created.

<x-mail::button :url="route('posts.show', $post->slug)">
Check it out
</x-mail::button>

Thanks,
{{ config('app.name') }}
</x-mail::message>
