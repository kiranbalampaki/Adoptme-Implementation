@extends('admin.dashboard')

@section('content')
{{-- @if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif --}}

<div class="card card border-left-primary shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add Products</h6>
                </div>
<div class="card-body">
 <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
    <div class="form-group row">
    <div class="col-6">
        <label for="name">Name</label>
        <input class="form-control" type="text" name="name">
    </div>
    <div class="col-6">
                <label for="image">Product Image</label>
                <input class="form-control p-1 col-8" type="file" name = "image">
    </div>
    </div>

    <div class="form-group row">
    <div class="col-4">
        <label for="category_id">Product Category</label>
        <select class="form-control" name="category_id">
            @if(count($categories)>0)
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->category_name}}</option>
            @endforeach
            @endif
        </select>
    </div>
    <div class="col-4">
        <label for="price">Price</label>
        <input class="form-control" type="number" name="price" min="1" max="any">
    </div>
    <div class="col-4">
        <label for="quantity">Stock</label>
        <input class="form-control" type="number" name="quantity" min="1" max="100">
    </div>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="summary-ckeditor" name="description"></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Add</button>
    @csrf
 </form>
 </div>
 </div>
@endsection