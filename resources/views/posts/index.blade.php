@extends('layouts.app')

@section('title', config('app.name') . ' - Posts')

@section('content')
    <h1>{{ config('app.name') . ' - Posts' }}</h1>

    @foreach ($posts as $post)
        <x-post :post="$post"></x-post>
    @endforeach
@endsection
