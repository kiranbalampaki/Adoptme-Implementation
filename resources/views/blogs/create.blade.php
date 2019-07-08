@extends('admin.dashboard')

@section('content')
<div class="card card border-left-primary shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add Blogs</h6>
                </div>
<div class="card-body">
 <form method="POST" action="{{route('blogs.store')}}" enctype="multipart/form-data">
    <div class="form-group row">
    <div class="col-6">
        <label for="title">Title</label>
        <input class="form-control" type="text" name="title">
    </div>
    <div class="col-6">
                <label for="image">Blog Image</label>
                <input class="form-control p-1 col-8" type="file" name = "image">
    </div>
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea class="form-control" id="summary-ckeditor" name="body"></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Add Blog</button>
    @csrf
 </form>
 </div>
 </div>
@endsection