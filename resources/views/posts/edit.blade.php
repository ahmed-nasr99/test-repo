@extends('app')

@section('title' , 'Edit '. $post->title)

@section('content')
    <h1 class="text-center">{{'Edit '. $post->title}}</h1>

    <form class="row" action="{{ url('posts/' . $post->id) }}" method="post">
        @csrf
        @method("PUT")
        <div class="col-6">
        <input type="text" class="form-control" name="title" placeholder="Post Title" aria-label="Post Title" value="{{ $post->title }}">
        </div>
        <div class="col-6">
            <input type="text" class="form-control" name="author" placeholder="Author" aria-label="Author" value="{{ $post->author }}">
        </div>
        <div class="col-6 mt-4">
        <textarea class="form-control" placeholder="Content" name="content" aria-label="content">{{ $post->content }}</textarea>
        </div>
        <div class="col-6 mt-4">
            <label for="published">Published</label>
            <input type="checkbox" id="published" name="published" {{ $post->published ? 'checked' : '' }} >
        </div>
        <button type="submit" class="btn btn-success mt-3 w-auto">Save</button>
    </form>

    @if(count($post->comments) > 0)
        @foreach($post->comments as $comment)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $comment->commenter }}</h5>
                    <p class="card-text">
                        {{ $comment->comment }}
                    </p>
                </div>
            </div>
        @endforeach
    @endif

@endsection
