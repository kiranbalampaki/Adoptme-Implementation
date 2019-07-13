@extends('layouts.app')

@section('content')

<div class="container mt-5">
<h2>Products</h2>
  <div class="row mt-5">
    <div class="col-3">
        <form method="GET" action="products">
            <div class="form-group row">
                <div class="col-12">
                    <label for="category">Categories</label><br>
                    @foreach($categories as $category)
                    <input type="checkbox" name="category" value="{{$category->id}}"> {{ $categories->where('id', $category->id)->pluck('category_name')->first() }}<br>
                    @endforeach
                </div>
            </div>
            <hr>
            <button class="btn btn-primary" type="submit">Filter</button>
        </form>
    </div>

    <div class="col-9 row">
        @foreach($products as $product)
            <div class="col-12 col-md-4 col-sm-6 col-lg-3 mb-5">
            <div class="card productcard">
                <div class="card-block">
                <div>
                    <img class="card-img-top img-fluid" style="width: 100%; height: 15vw; object-fit: cover;" src="assets/uploads/products/{{$product->product_image}}" alt="">
                </div>

                <div class="card-text px-3 text-center">
                    <h4 class="card-title mt-2">{{$product->product_name}}</h4>
                </div>
                                        
                <div class="card-footer overlay text-center py-5">
                    <a href="/pets/{{$product->id}}" class="btn btn-success text-white" role="button">Find More</a>
                </div>
                </div>
            </div>
            </div>
        @endforeach
  </div>
  </div>
</div>

@endsection