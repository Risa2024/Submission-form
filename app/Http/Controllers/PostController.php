<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function create() {
        return view('posts.create');//postsフォルダのcreate.blade.phpを表示
    }

    // 新しい投稿を保存するためのメソッド
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);
        $validated['user_id'] = auth()->id();
        Post::create($validated);
        $request->session()->flash('message', '保存しました');
        return back();
    }

    // 既存の投稿を更新するためのメソッド
    public function update(Request $request, Post $post) {
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);
        $validated['user_id'] = auth()->id();
        $post->update($validated);
        $request->session()->flash('message', '更新しました');
        return back();
    }

    public function index() {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
    public function show(Post $post) {
        return view('posts.show', compact('post'));
    }
    public function edit(Post $post) {
        return view('posts.edit', compact('post'));
    }
    public function destroy(Request $request, Post $post) {
        $post->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('posts.index');
    }
}

