
@extends('app')

@section('title' , 'All Posts')

@section('content')
    <h1 class="text-center mt-5">All Posts {{ $posts->count() }}</h1>

    <a class="btn btn-sm w-10 btn-primary" href="{{ url('posts/create') }}">Create New Post</a>
    <a class="btn btn-sm w-10 btn-info mt-3" href="{{ url('posts/archived') }}">Archived</a>

    @if(session()->has('message'))
        <div class="alert mt-3 alert-success">{{ session()->get('message') }}</div>
    @endif

    <table class="table mt-5 table-borderd">
        <thead>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Author</th>
            <th>Published</th>
            <th>Comments</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>

            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->content }}</td>
                    <td>{{ $post->author }}</td>
                    <td>{{ $post->published == true ? 'Published' : 'Not Published' }}</td>
                    <td>
                        {{ $post->comments()->count() }}
                    </td>
                    <td>
                        @if($post->trashed())
                            <a class="btn btn-primary" href="{{ url('posts/' . $post->id . '/restore') }}">restore </a>
                        @else
                            <a class="btn btn-primary" href="{{ url('posts/' . $post->id . '/edit') }}">Edit </a>
                        @endif
                    </td>
                    <td>
                        <form method="post" action="{{ url('posts/' . $post->id )}}">
                            @csrf
                            @method('DELETE')
                            <button onclick="confirm('Are You Sure?')" type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection


