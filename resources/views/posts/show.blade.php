// filepath: /c:/Users/safiy/OneDrive/Desktop/lost-found-project/resources/views/posts/show.blade.php
@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->description }}</p>
    <p>Date: {{ $post->date }}</p>
    <p>Location: {{ $post->location }}</p>
    <p>Contact Email: {{ $post->contact_email }}</p>
    <p>Contact Phone: {{ $post->contact_phone }}</p>
    <p>Category: {{ $post->category }}</p>
    <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection