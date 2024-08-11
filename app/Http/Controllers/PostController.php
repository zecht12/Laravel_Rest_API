<?php

namespace App\Http\Controllers;

use App\Models\PostModels;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostDetailResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $posts = PostModels::with(['writer:id,username','comments:id,user_id,post_id,comments_content', 'comments.commentator:id,username'])->get();
        return PostDetailResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required',
        ]);

        $request['author'] = Auth::user()->id;
        $post = PostModels::create($request->all());
        return new PostDetailResource($post->loadMissing(['writer:id,username','comments:id,user_id,post_id,comments_content', 'comments.commentator:id,username']));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $posts = PostModels::with(['writer:id,username','comments:id,user_id,post_id,comments_content', 'comments.commentator:id,username'])->get();
        return PostDetailResource::collection($posts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required',
        ]);

        $post = PostModels::findOrFail($id);
        $post->update($request->all());
        return new PostDetailResource($post->loadMissing(['writer:id,username','comments:id,user_id,post_id,comments_content', 'comments.commentator:id,username']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = PostModels::findOrFail($id);
        $post->delete();
        return new PostDetailResource($post->loadMissing(['writer:id,username','comments:id,user_id,post_id,comments_content', 'comments.commentator:id,username']));
    }
}
