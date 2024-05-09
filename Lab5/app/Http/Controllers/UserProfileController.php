<?php

namespace App\Http\Controllers;

use App\Models\Creator;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class UserProfileController extends Controller
{
    //
    public function show(User $user)
    {
        $userId = Auth::id();

        // dd($userId);
        $posts = Post::where('creator_id', $userId)->paginate(10);
        // dd($posts);

        return view('profile', compact('user', 'posts'));
    }
}
