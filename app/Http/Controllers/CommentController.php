<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentModels;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comments_content' => 'required',
        ]);

        $request['user_id'] = Auth::user()->id;
        $comment = CommentModels::create($request->all());
        return new CommentResource($comment->loadMissing(['commentator:id,username']));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = CommentModels::with('commentator:id,username')->findOrFail($id);
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'comments_content' => 'required',
        ]);

        $comment = CommentModels::findOrFail($id);
        $comment->update($request->only('comments_content'));
        return new CommentResource($comment->loadMissing(['commentator:id,username']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = CommentModels::findOrFail($id);
        $comment->delete();
        return new CommentResource($comment->loadMissing(['commentator:id,username']));
    }
}
