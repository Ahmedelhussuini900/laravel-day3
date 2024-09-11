@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h1>Edit Post</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>
        @error('title')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="posted_by">Post Creator:</label>
        <select name="posted_by" id="posted_by" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $post->posted_by ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        @error('posted_by')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="created_at">Created At:</label>
        <input type="text" name="created_at" id="created_at" value="{{ old('created_at', $post->created_at) }}">

        <label for="image">Image:</label>
        <input type="file" name="image" id="image">

        <button type="submit">Update Post</button>
    </form>
@endsection
