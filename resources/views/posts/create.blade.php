<x-layouts.app>
    <x-slot:title>{{ 'Add a new post - ' . config('app.name') }}</x-slot:title>
    <x-create-post-form :categories="$categories"></x-create-post-form>
</x-layouts.app>
