<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function store(Request $request){

        $request->validate([
            'file' => 'required|file|max:10240',
            'caption' => 'required',
        ]);
        $file = $request->file('file');
        $filePath = $file->store('posts');

        $post = new Post();
        $post->user_id = auth()->id();
        $post->caption = $request->caption;
        $post->file_path = $filePath;
        $post->save();

        return response()->json([
            'message' => 'Post created successfully',
            'post' => new PostResource($post),
        ], 201);
    }

    public function search(Request $request){
        $searchTerm = $request->input('query');
        $posts = Post::where('caption', 'like', '%' . $searchTerm . '%')->get();

        return PostResource::collection($posts);
    }
}
