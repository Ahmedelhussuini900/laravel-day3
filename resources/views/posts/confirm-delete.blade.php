@extends('layouts.app')

@section('title', 'Confirm Delete')

@section('content')
    <h1>Confirm Deletion</h1>

    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <p>Are you sure you want to delete the post titled "{{ $post->title }}"?</p>
        <button type="submit">Yes, Delete</button>
        <a href="{{ route('posts.index') }}">No, Cancel</a>
    </form>
@endsection
