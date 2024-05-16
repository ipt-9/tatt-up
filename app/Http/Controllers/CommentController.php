<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post){
        $request->validate([
            'body' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id;
        $comment->save();

        return response()->json(['message' => 'Comment added successfully']);
    }

    public function getComments(Post $post){
        $comments = $post->comments()->with('user')->get();

        return response()->json([
            'message' => 'Comments retrieved successfully',
            'comments' => $comments
        ]);
    }
}
