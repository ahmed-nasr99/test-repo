@extends('app')

@section('title' , 'Create New Post')

@section('content')
    <h1 class="text-center">Create New Post</h1>

    <form class="row" action="{{ route('posts.store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >

        <div class="col-6">
        <input type="text" class="form-control" name="title" placeholder="Post Title" aria-label="Post Title" value="{{old('title')}}">
        @error('title')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
        <div class="col-6">
            <input type="text" class="form-control" name="author" placeholder="Author" aria-label="Author" value="{{old('author')}}">
            @error('author')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-6 mt-4">
        <textarea class="form-control" placeholder="Content" name="content" aria-label="content">{{old('content')}}</textarea>
        @error('content')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
        <div class="col-6 mt-4">
            <label for="published">Published</label>
            <input type="checkbox" id="published" name="published" checked>
        </div>
        <button type="submit" class="btn btn-success mt-3 w-auto">Save</button>
    </form>
@endsection
