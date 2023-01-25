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
        <div class="bg-white">
            <div>
                <h2 id="reviews-heading" class="sr-only">Comments</h2>

                @foreach ($post->comments as $comment)
                    <div class="space-y-10">
                        <div class="flex flex-col sm:flex-row">
                            <div class="order-2 mt-6 sm:mt-0 sm:ml-16">
                                <p class="sr-only">5 out of 5 stars</p>

                                <div class="mt-3 space-y-6 text-sm text-gray-600">
                                    <p>{{ $comment->content }}</p>
                                </div>
                            </div>

                            <div class="order-1 flex items-center sm:flex-col sm:items-start">
                                <img src="https://source.unsplash.com/random?sig={{ $comment->author->id }}&ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80"
                                    alt="{{ $comment->author->name }}" class="h-12 w-12 rounded-full">

                                <div class="ml-4 sm:ml-0 sm:mt-4">
                                    <p class="text-sm font-medium text-gray-900">{{ $comment->author->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

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
