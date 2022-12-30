<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ 'Add a new post - ' . config('app.name') }}</title>
</head>

<body>
    <h3>Add a new post</h3>
    <form method="post" action="{{ route('posts.store') }}">
        @csrf
        <label for="category">Category: </label>
        <select name="category_id" id="category">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        </br>

        <label for="title">Title: </label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" /><br />
        @error('title')
            <div style="color: red">
                {{ $message }}
            </div>
        @enderror

        <label for="excerpt">Excerpt: </label>
        <textarea name="excerpt" id="excerpt">{{ old('excerpt') }}</textarea><br />

        <label for="content">Content: </label>
        <textarea name="content" id="content">{{ old('content') }}</textarea><br />

        <button type="submit">Save post</button>
    </form>
</body>

</html>
