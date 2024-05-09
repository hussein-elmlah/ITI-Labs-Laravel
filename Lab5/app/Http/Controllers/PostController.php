<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Creator;
use Spatie\Tags\Tag;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $posts = Post::all();
        // return view("index", ["posts" => $posts]);

        $posts = Post::paginate(5,['*'],'posts');
        return view('posts.index', compact('posts'));

    }

    public function tagged()
    {
        $tag = request()->get('tag');

        $tags = Tag::all();

        // Handle empty or null tag
        if (empty($tag)) {
            // $posts = Post::paginate(3); // Retrieve and paginate all posts
            $posts = [];
        } else {
            $posts = Post::withAnyTags([$tag])->paginate(3); // Filter and paginate by specific tag(s)
        }

        return view('posts.tagged', compact('posts', 'tags'));
    }

    public function show($slug)
    {
        // dd($slug);
        $post = Post::where('slug', $slug)->first();
        return $post ? view('posts.show', ["post" => $post]) : abort(404);
    }

    // public function show($id)
    // {
    //     $post = Post::find($id);
    //     return $post ? view('posts.show', ["post" => $post]) : abort(404);
    // }

    public function create()
    {
        $creators = Creator::all();
        return view('posts.create', compact('creators'));
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

    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $filePath = null;
        if ($request->hasFile('image')) {

            $requestParams = request();
            $filePath = $this->file_operations($requestParams);

            $validated['image'] = $filePath;
        } else {
            $validated['image'] = "https://assets.materialup.com/uploads/9ffe2f61-1193-494f-97a3-d9e334335ae0/preview.jpg";
        }

        $post = Post::create($validated);

        // $tags = collect($request->tags)->map(function ($tag) {
        //     return Tag::firstOrCreate(['name' => $tag]);
        // })->pluck('id');

        $tags_str = $request->tags; // Assuming the tags are stored in the 'tags' field of the request object

        # Split the string into individual tags
        $tags = explode(',', $tags_str);

        # Optional: Remove leading/trailing whitespace from each tag
        $tags = array_map('trim', $tags);

        $post->syncTags($tags);

        return to_route('posts.index');
    }

    public function edit($id)
    {
        $post = Post::find($id);

        $this->authorize('update', $post);

        return $post ? view('posts.edit', ["post" => $post]) : abort(404);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $this->authorize('update', $post);

        if ($post) {
            $post->update($request->all());
            return to_route('posts.index');
        }

        return abort(404);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        $this->authorize('delete', $post);

        if ($post) {

            if (file_exists(public_path('' . $post->image))) {
                unlink(public_path('' . $post->image));
            }

            $post->delete();
            return to_route('posts.index');
        }

        return abort(404);
    }

    // public function restore($id)
    // {
    //     $post = Post::withTrashed()->find($id);

    //     if ($post) {
    //         $post->restore();
    //         return redirect()->route('posts.index');
    //     }

    //     return abort(404);
    // }

    public function restoreAll()
    {
        Post::withTrashed()->restore();
        return redirect()->route('posts.index');
    }
}
