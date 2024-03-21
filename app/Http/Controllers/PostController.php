<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function store(Request $request){
        $post = new Post();
        $post->user_id = auth()->id();
        $post->likes = $request->likes;
        $post->caption = $request->caption;
        $post->file_path = $request->file_path;
        $post->save();

        return redirect()->route('posts.index');
    }

    public function search(Request $request){
        $searchTerm = $request->input('query');
        $posts = Post::where('caption', 'like', '%' . $searchTerm . '%')->get();

        return PostResource::collection($posts);
    }
}
