<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Discussion $discussion)
    {
        return view('comments.create', compact('discussion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Discussion $discussion)
    {
        $commentAttributes = $request->validate([
            'content' => ['required', 'string']
        ]);

        $comment = new Comment($commentAttributes);
        $comment->user_id = Auth::user()->id;
        $comment->discussion_id = $discussion->id;
        $comment->save();

        return redirect()->route('discussions.show', $discussion)->with('status', 'Comment posted.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $comment = Comment::findOrFail($comment->id);
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $commentAttributes = $request->validate([
            'content' => ['required', 'string']
        ]);

        $comment->update($commentAttributes);
        $comment->save();

        return redirect()->route('discussions.show', $comment->discussion)->with('status', 'Comment edited.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment = Comment::findOrFail($comment->id);
        $comment->delete();
        return redirect()->route('discussions.show', $comment->discussion)->with('deletion', 'Comment deleted.');
    }
}
