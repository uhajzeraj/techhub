@extends('layouts.app')

@section('title', config('app.name') . ' - Posts')

@section('content')
    <h1>{{ config('app.name') . ' - Posts' }}</h1>

    @foreach ($posts as $post)
        <a href="{{ route('posts.show', $post->slug) }}">
            <h3>{{ $post->title }}</h3>
        </a>
        <a href="{{ route('authors.show', $post->author->username) }}">
            <h4>Written by: {{ $post->author->name }}</h4>
        </a>
        <article>{{ $post->excerpt }}</article>
    @endforeach
@endsection
