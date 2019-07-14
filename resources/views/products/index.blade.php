@extends('layouts.app')

@section('content')

<div class="container-fluid mt-5 px-5">
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
            <div class="col-12 col-sm-8 col-md-6 col-lg-4 mb-5">
                <div class="card">
                    <img class="card-img mt-3" style="height:80%; width:80%; margin:auto" src="assets/uploads/products/{{$product->product_image}}" alt="Vans">
                    <div class="overlay">
                        <div class="cartbutton text-right mt-3 mr-3">
                            <a href="{{ url('add-to-cart/'.$product->id) }}" class="btn btn-primary btn-md"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                    <hr>
                    <h4 class="card-title">{{$product->product_name}}</h4>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $categories->where('id', $product->category_id)->pluck('category_name')->first() }}</h6>
                    <p class="card-text">{!!str_limit($product->description, 150, '...')!!}</p>
                    <div class="buy d-flex justify-content-between align-items-center">
                        <div class="price text-success"><h5 class="mt-4">Rs.{{$product->price}}</h5></div>
                        <a href="/" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                    </div>
                    </div>
                </div>
                </div>
        @endforeach
  </div>
  </div>
</div>

@endsection