<x-layouts.app>
    <x-slot:title>{{ $post->title . ' - ' . config('app.name') }}</x-slot:title>
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

    <div class="max-w-xl m-auto">
        <form method="POST" action="{{ route('post-comments.store', $post->id) }}">
            @csrf
            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700">Add your comment</label>
                <div class="mt-1">
                    <textarea rows="4" name="content" id="comment"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Create</button>
                </div>
            </div>
        </form>
    </div>
</x-layouts.app>
