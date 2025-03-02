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
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        $request->session()->flash('message', '保存しました');
        return back();
    }
}
