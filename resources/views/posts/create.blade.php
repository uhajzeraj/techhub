@extends('layouts.app')

@section('title', 'Add a new post - ' . config('app.name'))

@section('content')
    <h3>Add a new post</h3>
    <form method="post" action="{{ route('posts.store') }}">
        @csrf
        <label for="category">Category: </label>
        <select name="category_id" id="category">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') === (string) $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        </br>
        @error('category_id')
            <div style="color: red">
                {{ $message }}
            </div>
        @enderror

        <label for="title">Title: </label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" /><br />
        @error('title')
            <div style="color: red">
                {{ $message }}
            </div>
        @enderror

        <label for="excerpt">Excerpt: </label>
        <textarea name="excerpt" id="excerpt">{{ old('excerpt') }}</textarea><br />
        @error('excerpt')
            <div style="color: red">
                {{ $message }}
            </div>
        @enderror

        <label for="content">Content: </label>
        <textarea name="content" id="content">{{ old('content') }}</textarea><br />
        @error('content')
            <div style="color: red">
                {{ $message }}
            </div>
        @enderror

        <button type="submit">Save post</button>
    </form>

@endsection
