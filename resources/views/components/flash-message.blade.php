@if (session('success'))
    <div x-data="{ show: false }" x-init="show = true;
    setTimeout(() => show = false, 2500)" x-show="show" x-cloak x-transition
        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded fixed bottom-5 right-8"
        role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif
