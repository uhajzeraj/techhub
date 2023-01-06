@extends('layouts.app')

@section('title', $post->title . ' - ' . config('app.name'))

@section('content')
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
@endsection
