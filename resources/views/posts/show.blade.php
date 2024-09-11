@extends('layouts.app')

@section('content')
<div>
    <h1>{{ $post->title }}</h1>
    <p>Posted by: {{ $post->user ? $post->user->name : 'Unknown' }}</p>
    <p>Created at: {{ $post->formatted_created_at }}</p>

    
    <style>
        .tiny-image {
            width: 100px; 
            height: auto; 
        }
    </style>

    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="tiny-image">

    <h2>Comments</h2>
    @foreach ($post->comments as $comment)
        <div>
            <strong>{{ $comment->user->name }}:</strong>
            <p>{{ $comment->content }}</p>
        </div>
    @endforeach

    <!-- Comment form -->
    <form action="{{ route('comments.store', $post->id) }}" method="POST">
    @csrf
    <textarea name="content" rows="3" placeholder="Add a comment..." required></textarea>
    <button type="submit">Post Comment</button>
</form>
</div>
@endsection
