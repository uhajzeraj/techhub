@props(['href'])

<a href="{{ $href }}"
    class="inline-flex items-center border-b-2 {{ request()->is(ltrim($href, '/')) ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500' }} px-1 pt-1 text-sm font-medium hover:border-gray-300 hover:text-gray-700">
    {{ $slot }}
</a>
