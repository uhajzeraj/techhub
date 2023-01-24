<select name="category"
    class="block w-full rounded-md border-gray-300 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ $category->id === (int) request()->get('category') ? 'selected' : '' }}>
            {{ $category->name }}</option>
    @endforeach
</select>
