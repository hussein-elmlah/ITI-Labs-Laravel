<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        $this->posts = Post::all();
        return view("index", ["posts" => $this->posts]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('show', ["post" => $post]);
    }

    public function create()
    {
        return view("create");
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());

        $this->posts = Post::all();
        return view('index', ["posts" => $this->posts]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('edit', ["post" => $post]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return view('edit', ["post" => $post]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        $this->posts = Post::all();
        return view('index', ["posts" => $this->posts]);
    }
}

