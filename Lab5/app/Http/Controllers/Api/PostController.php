<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Creator;
use Spatie\Tags\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $posts = Post::all();
        // return response()->json($posts);

        // $perPage = $request->query('per_page', 5);
        // $posts = Post::paginate($perPage);
        // return response()->json($posts);

        // $posts = Post::paginate(5,['*'],'posts');
        // return response()->json($posts);

        $page = $request->query('page', 1);
        $limit = $request->query('limit', 5);

        $dataToValidate = [
            'page' => $page ,
            'limit' => $limit ,
        ];

        $validator = Validator::make($dataToValidate, [
            'page' => 'required|integer|min:1',
            'limit' => 'required|integer|min:1|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $posts = Post::paginate($limit, ['*'], 'posts', $page);

        return response()->json($posts);

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        // $tags_str = $request->tags;
        // $tags = explode(',', $tags_str);
        // $tags = array_map('trim', $tags);
        // $post->syncTags($tags);

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($post);
    }
    // public function show($slug)
    // {
    //     $post = Post::where('slug', $slug)->first();

    //     if (!$post) {
    //         return response()->json(['message' => 'Post not found'], 404);
    //     }

    //     return response()->json($post);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // $this->authorize('update', $post);

        // $validator = Validator::make($request->all(), [
        //     // Define validation rules for update request
        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }


        $post->update($request->all());

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $this->authorize('delete', $post);


        if (file_exists(public_path('' . $post->image))) {
            unlink(public_path('' . $post->image));
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
