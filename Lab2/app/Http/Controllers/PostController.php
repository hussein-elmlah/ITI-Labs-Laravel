<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view("index", ["posts" => $posts]);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return $post ? view('show', ["post" => $post]) : abort(404);
    }

    public function create()
    {
        return view("create");
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());
        return to_route('posts.index');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return $post ? view('edit', ["post" => $post]) : abort(404);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->update($request->all());
            return to_route('posts.index');
        }

        return abort(404);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return to_route('posts.index');
        }

        return abort(404);
    }
}
