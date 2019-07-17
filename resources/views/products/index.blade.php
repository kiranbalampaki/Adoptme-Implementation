@extends('layouts.app')

@section('content')
<style>
.card{
    border:none;
}

#unstyled-link{
    text-decoration:none;
    color:inherit;
}
</style>

<div class="container-fluid mt-5 px-5">
<h2 class="font-weight-bold">Products</h2>
  <div class="row mt-5">
    <div class="col-3">
        <form method="GET" action="products">
            <div class="form-group row">
                <div class="col-12">
                    <label for="category">Categories</label><br>
                    @foreach($categories as $category)
                    <input type="radio" name="category[]" value="{{$category->id}}" <?php if (isset($_GET['category']) && in_array($category->id, $_GET['category'])) { echo "checked='checked'"; } ?>>
                    {{ $categories->where('id', $category->id)->pluck('category_name')->first() }}
                    [{{ $allproducts->where('category_id', $category->id)->count('id') }}]<br>
                    @endforeach
                </div>
            </div>
            <hr>
            <button class="btn btn-primary" type="submit">Filter</button>
        </form>
    </div>

    <div class="col-9">
    <div class="row">
        @foreach($products as $product)
            <div class="col-12 col-sm-8 col-md-6 col-lg-3 mb-5 p-1">
                <div class="card">
                    <img class="card-img mt-3" style="height:80%; width:80%; margin:auto" src="assets/uploads/products/{{$product->product_image}}" alt="">
                    <div class="overlay">
                        <div class="cartbutton text-right mt-3 mr-3">
                            <a href="{{ url('add-to-cart/'.$product->id) }}" class="btn btn-outline-dark btn-md"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                    <hr>
                    <p class="card-subtitle mb-2 text-muted" style="font-size:12px"><a href="/products?category%5B%5D={{$product->category_id}}" id="unstyled-link">{{ $categories->where('id', $product->category_id)->pluck('category_name')->first() }}</a></p>
                    <p class="card-title font-weight-bold"><a href="/products/{{$product->id}}" id="unstyled-link">{{$product->product_name}}</a></p>
                    <p class="card-title">Rs. {{$product->price}}</p>

                    <?php $rating = $reviews->where('product_id', $product->id)->avg('rating') ?>

                    <p>
                        <div>
                            @for ($i = 0; $i < 5; $i++)
                                @if($rating>0)
                                    @if($rating >0.5)
                                        <i class="fa fa-star"></i>
                                    @else
                                        <i class="fa fa-star-half-empty"></i>
                                    @endif
                                    @php $rating--; @endphp
                                @else
                                    <i class="fa fa-star-o"></i>
                                @endif
                            @endfor
                            <span class="small">
                            @if (count($reviews->where('product_id', $product->id))>0)
                            ({{$reviews->where('product_id', $product->id)->avg('rating')}})
                            @else
                            (0 reviews)
                            @endif
                            </span>
                        </div>
                    </p>
                    {{-- <a href="/" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a> --}}
                    </div>
                </div>
                </div>
        @endforeach
    </div>
    <div class="mt-4">{{$products->links()}}</div>
    </div>
    </div>
</div>
<script>
</script>
@endsection