<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use App\Models\Post;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        //
        // Validate the request data
        $request->validate([
            'content' => 'required|string',
        ]);

        // Find the post by ID


        // Create a new comment instance
        $comment = new Comment();
        $comment->content = $request->input('content');

        // Save the comment to the post
        $post->comments()->save($comment);

        // Redirect back to the post page or any other page as needed
        return redirect()->route('posts.show', $post->id)->with('success', 'Comment added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Comments $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comments $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comments $comments)
    {
        //
    }
}
