<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function create() {
        return view('posts.create');//postsフォルダのcreate.blade.phpを表示
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);
        $post = Post::create($validated);
        $request->session()->flash('message', '保存しました');
        return back();
    }
}
