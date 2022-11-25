<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        // dd(url('/posts') , route('posts.index'));
        $posts = Post::all();

        return view('posts.index', [
            'posts' => $posts
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function archived()
    {
        $posts = Post::onlyTrashed()->get();

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'unique:posts' , 'max:255'],
            'content' => ['required', 'string', 'max:500'],
            'author' => ['required', 'string', 'max:255'],
            'published' => ['nullable'],
        ]);

        $post = new Post;
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->author = $request->get('author');
        $post->published = $request->boolean('published');
        $post->save();
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.edit' , [
            'post' => $post
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit' , [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->author = $request->get('author');
        $post->published = $request->boolean('published');
        $post->save();
        session()->flash('message' , 'Post updated successfully');
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) //route model binding
    {
        $post->delete();
        session()->flash('message' , 'Post deleted successfully');
        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id) //route model binding
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        session()->flash('message' , 'Post restored successfully');
        return redirect('/posts');
    }
}
