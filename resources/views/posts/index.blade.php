<x-layouts.app>
    <div class="relative bg-gray-50 px-6 pt-16 pb-20 lg:px-8 lg:pt-24 lg:pb-28">
        <div class="absolute inset-0">
            <div class="h-1/3 bg-white sm:h-2/3"></div>
        </div>
        <div class="relative mx-auto max-w-7xl">
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">From the blog</h2>
                <p class="mx-auto mt-3 max-w-2xl text-xl text-gray-500 sm:mt-4">Lorem ipsum dolor sit amet consectetur,
                    adipisicing elit. Ipsa libero labore natus atque, ducimus sed.</p>
            </div>
            <div class="flex w-full">
                <label for="search" class="block text-sm font-medium text-gray-700">Search posts</label>
                <form method="GET" action="{{ route('posts.index') }}">
                    <div class="relative mt-1 flex items-center">
                        <select name="category"
                            class="block w-full rounded-md border-gray-300 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id === (int) request()->get('category') ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" value="{{ request()->get('search', '') }}" name="search" id="search"
                            class="block w-full rounded-md border-gray-300 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                            <kbd
                                class="inline-flex items-center rounded border border-gray-200 px-2 font-sans text-sm font-medium text-gray-400">⌘K</kbd>
                        </div>
                    </div>
                </form>
            </div>
            <div class="mx-auto mt-12 grid max-w-lg gap-5 lg:max-w-none lg:grid-cols-3">
                @foreach ($posts as $post)
                    <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover"
                                src="https://source.unsplash.com/random?sig={{ $post->id }}&ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80"
                                alt="">
                        </div>
                        <div class="flex flex-1 flex-col justify-between bg-white p-6">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-indigo-600">
                                    <a href="#" class="hover:underline">{{ $post->category->name }}</a>
                                </p>
                                <a href="{{ route('posts.show', $post->slug) }}" class="mt-2 block">
                                    <p class="text-xl font-semibold text-gray-900">{{ $post->title }}</p>
                                    <p class="mt-3 text-base text-gray-500">{{ $post->excerpt }}</p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <a href="#">
                                        <span class="sr-only">{{ $post->author->name }}</span>
                                        <img class="h-10 w-10 rounded-full"
                                            src="https://www.gravatar.com/avatar/{{ $post->author->id }}?s=32&d=identicon&r=PG"
                                            alt="">
                                    </a>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        <a href="{{ route('authors.show', $post->author->username) }}"
                                            class="hover:underline">{{ $post->author->name }}</a>
                                    </p>
                                    <div class="flex space-x-1 text-sm text-gray-500">
                                        <time datetime="{{ $post->created_at->format('Y-m-d') }}"
                                            title="{{ $post->created_at->toCookieString() }}">{{ $post->created_at->diffForHumans() }}</time>
                                        <span aria-hidden="true">&middot;</span>
                                        <span>6 min read</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $posts->links() }}
        </div>
    </div>
</x-layouts.app>
