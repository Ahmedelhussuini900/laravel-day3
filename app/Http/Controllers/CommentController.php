<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function storeComment(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $post = Post::findOrFail($postId);

        $comment = new Comment([
            'content' => $request->input('content'),
            'user_id' => 1, 
        ]);

        $post->comments()->save($comment);

        return redirect()->route('posts.show', $postId)->with('success', 'Comment added successfully!');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        $post->formatted_created_at = Carbon::parse($post->created_at)->format('l, F j, Y g:i A');

        return view('posts.show', compact('post'));
    }
}