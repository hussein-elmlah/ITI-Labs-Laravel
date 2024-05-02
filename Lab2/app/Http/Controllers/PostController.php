<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::all();
        // return view("index", ["posts" => $posts]);

        $posts = Post::paginate(5,['*'],'posts');
        return view('index', compact('posts'));

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

    private function file_operations($request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

            $intial_filePath = $image->store('images', 'post_upload');

            $filePath = "images/posts/" . $intial_filePath ;

            return $filePath;
        }

        return null;
    }

    public function store(Request $request)
    {
        $requestParams = request();
        $filePath = $this->file_operations($requestParams);

        $post = new Post();

        $post->title = $requestParams['title'];
        $post->description = $requestParams['description'];
        $post->author = $requestParams['author'];
        $post->image = $filePath;
        $post->save();

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
