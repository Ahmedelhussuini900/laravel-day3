@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <h1>Create Post</h1>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        @error('title')
            <div class="error">{{ $message }}</div>
        @enderror
        
        <label for="posted_by">Post Creator:</label>
        <select name="posted_by" id="posted_by" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        @error('posted_by')
            <div class="error">{{ $message }}</div>
        @enderror
        
        <label for="created_at">Created At:</label>
        <input type="text" name="created_at" id="created_at">
        
        <label for="image">Image:</label>
        <input type="file" name="image" id="image">
        
        <button type="submit">Save Post</button>
    </form> 
@endsection
    