<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Validation\Rule;
use App\Http\Resources\PostResource;
class ApiPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json(PostResource::collection($posts) , 200);
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
            'published' => ['nullable' , 'boolean'],
        ]);

        $post = new Post;
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->author = $request->get('author');
        $post->published = $request->get('published' , true);
        if ($post->save()) {
            $response = ['message' => 'Post Created Successfully' , 'post' => $post ];
            return response()->json($response, 201);
        } else {
            $response = ['message' => 'Something went wrong, try again later'];
            return response()->json($response, 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'post' => null,
                'message' => 'Post Not Found'
            ], 404);
        }

        return response()->json([
            'post' => new PostResource($post),
            'message' => 'Post Found Successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', Rule::unique('posts')->ignore($id) , 'max:255'],
            'content' => ['required', 'string', 'max:500'],
            'author' => ['required', 'string', 'max:255'],
            'published' => ['nullable' , 'boolean'],
        ]);

        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'post' => null,
                'message' => 'Post Not Found'
            ], 404);
        }


        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->author = $request->get('author');
        $post->published = $request->get('published' , true);
        if ($post->save()) {
            $response = ['message' => 'Post Updated Successfully' , 'post' => $post ];
            return response()->json($response);
        } else {
            $response = ['message' => 'Something went wrong, try again later'];
            return response()->json($response, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'post' => null,
                'message' => 'Post Not Found'
            ], 404);
        }
        $post->delete();
        $response = ['message' => 'Post deleted Successfully' , 'post' => $post ];
        return response()->json($response);
    }
}
