<?php

namespace App\Http\Controllers;
use App\Models\Comment; 

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
{
    
    $posts = Post::with('user')->withTrashed()->paginate(10);
    

    $posts->each(function ($post) {
        $post->formatted_date = Carbon::parse($post->created_at)->format('Y-m-d H:i');
    });
    
    return view('posts.index', compact('posts'));
}

public function create()
    {
        $users = User::all();
        return view('posts.create', compact('users'));
    }

public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|unique:posts,title',
            'posted_by' => 'required|exists:users,id',
            'created_at' => 'nullable|date',
            'image' => 'nullable|image',
        ]);

        $post = new Post([
            'title' => $request->input('title'),
            'posted_by' => $request->input('posted_by'),
            'created_at' => $request->input('created_at'),
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $post->image = $image->store('images', 'public');
        }

        $post->save();

        return redirect()->route('posts.show', $post->id)->with('success', 'Post created successfully!');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        $post->formatted_created_at = Carbon::parse($post->created_at)->format('F j, Y');

        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $users = User::all();
        return view('posts.edit', compact('post', 'users'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => [
                'required',
                'string',
                'min:3',
                Rule::unique('posts', 'title')->ignore($post->id), 
            ],
            'posted_by' => 'required|exists:users,id',
            'created_at' => 'nullable|date',
            'image' => 'nullable|image',
        ]);

        $post->title = $request->input('title');
        $post->posted_by = $request->input('posted_by');
        $post->created_at = $request->input('created_at');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $post->image = $image->store('images', 'public');
        }

        $post->save();

        return redirect()->route('posts.show', $post->id)->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            \Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }

    public function confirmDelete($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.confirm-delete', compact('post'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('posts.index')->with('success', 'Post restored successfully.');
    }
}
