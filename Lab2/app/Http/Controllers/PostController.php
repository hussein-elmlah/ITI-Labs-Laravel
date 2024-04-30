<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $post = Post::create($request->all());

        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return $post ? view('edit', ["post" => $post]) : abort(404);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $post = Post::find($id);
        if ($post) {
            $post->update($request->all());
            return redirect()->route('posts.index');
        }

        return abort(404);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return redirect()->route('posts.index');
        }

        return abort(404);
    }
}
