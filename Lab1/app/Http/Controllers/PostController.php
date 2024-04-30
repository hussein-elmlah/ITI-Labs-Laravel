<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private $posts = [
        ['id' => 1, 'title' => 'title1', 'description' => 'description1', 'author' => 'Ahmed Ali', 'createdAt' => '11/11/2024', 'updatedAt' => '11/11/2024', 'image' => 'img1.jpg'],
        ['id' => 2, 'title' => 'title2', 'description' => 'description2', 'author' => 'Ahmed Ali', 'createdAt' => '11/11/2024', 'updatedAt' => '11/11/2024', 'image' => 'img2.jpeg'],
        ['id' => 3, 'title' => 'title3', 'description' => 'description3', 'author' => 'Ahmed Ali', 'createdAt' => '11/11/2024', 'updatedAt' => '11/11/2024', 'image' => 'img3.jpeg'],
        ['id' => 4, 'title' => 'title4', 'description' => 'description4', 'author' => 'Ahmed Ali', 'createdAt' => '11/11/2024', 'updatedAt' => '11/11/2024', 'image' => 'img4.jpeg']
    ];

    public function index()
    {
        return view("index", ["posts" => $this->posts]);
    }

    public function show($id)
    {
        $post = $this->getPostById($id);
        return $post ? view('show', ["post" => $post]) : abort(404);
    }

    public function create()
    {
        return view("create");
    }

    public function edit($id)
    {
        $post = $this->getPostById($id);
        return $post ? view('edit', ["post" => $post]) : abort(404);
    }

    public function destroy($id)
    {
        $post = $this->getPostById($id);
        return $post ? view('destroy', ["post" => $post]) : abort(404);
    }

    private function getPostById($id)
    {
        return $id <= count($this->posts) ? $this->posts[$id - 1] : null;
    }
}
