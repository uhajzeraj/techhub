<x-mail::message>
    # Introduction

    Your post was created.

    <x-mail::button :url="''">
        Check it out
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
