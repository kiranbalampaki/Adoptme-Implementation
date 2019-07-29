@extends('layouts.app')

@section('content')
    <section class="container-fluid row banner">
        <div class="my-auto col-10 text-center">
            <h1 style="font-weight:bold; font-size:4vw;">Do you want to<br>find <font color="#55dcd6">a best friend?</font></h1>
            <h3 style="font-size:2vw;">We will help you find a best friend.</h3>
            <a class="btn bannerbutton">Find a Pet</a>
        </div>
        <div class="col-2"></div>
    </section>

<div class="container py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Pets</h1>
        <a href="/pets" class="d-none d-sm-inline-block btn btn-md btn-primary">View All</a>
    </div>
      <div class="row">
          @foreach($pets as $pet)<a href="/pets/{{$pet->id}}">
              <div class="col-12 col-sm-8 col-md-6 col-lg-3 mb-5 p-1">
                  <div class="card">
                      <img class="card-img mt-3 mx-auto" style="width: 90%; height: 15vw; object-fit: cover;" src="../assets/uploads/pets/{{$pet->pet_photo}}" alt="">
                      <div class="card-body text-center">
                      <a href="/pets/{{$pet->id}}" id="unstyled-link" style="font-size:17px;">
                      <p class="card-title font-weight-bold">{{$pet->name}}</p>
                      <p class="card-subtitle mb-2 text-muted" style="font-size:12px">{{ $pet->breed }}</p></a>
                      {{-- <a href="/" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a> --}}
                      </div>
                  </div>
                  </div></a>
          @endforeach
      </div>
</div>


    <div class="container-fluid img-fluid text-center text-white infobanner p-5">
    <h2 style="font-size:2vw;">First Time ?<br>Everything you need to know</h2>
    <h4 style="font-size:1.5vw;">Use our helpful guides to learn more about<br>
        the steps of adopting your new friend and<br> what you need to do.</h4>
    <a href="/help" id="unstyled-link" class="btn btn-outline-primary px-4 py-2" style="border:1px solid white; border-radius:50px; font-size:1vw;">Learn how it works.</a>
    </div>

<div class="container py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Products</h1>
        <a href="/products" class="d-none d-sm-inline-block btn btn-md btn-primary">View All</a>
    </div>
      <div class="row">
          @foreach($products as $product)<a href="/pets/{{$product->id}}">
              <div class="col-12 col-sm-8 col-md-6 col-lg-3 mb-5 p-1">
                  <div class="card text-center">
                      <img class="card-img mt-3" style="height:80%; width:80%; margin:auto" src="../assets/uploads/products/{{$product->product_image}}" alt="">
                      <div class="card-body">
                      <a href="/products/{{$product->id}}" id="unstyled-link" style="font-size:17px;">
                      <p class="card-title font-weight-bold">{{$product->product_name}}</p>
                      <p class="card-subtitle mb-2 text-muted" style="font-size:12px">{{ $categories->where('id', $product->category_id)->pluck('category_name')->first() }}</p></a>
                      {{-- <a href="/" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a> --}}
                      </div>
                  </div>
                  </div></a>
          @endforeach
      </div>
</div>

<div class="container py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Blogs</h1>
        <a href="/blogs" class="d-none d-sm-inline-block btn btn-md btn-primary">View All</a>
    </div>

    <div class="row">
        @if(count($blogs)>0)
            @foreach($blogs as $blog)
                <div class="col-sm-6 col-md-4 col-lg-4 mt-2">
                    <div class="card">
                        <div class="card-block">
                            <div>
                                <img class="card-img-top img-fluid" style="width: 100%; height: 15vw; object-fit: cover;" src="assets/uploads/blogimages/{{$blog->blog_image}}" alt="">
                            </div>

                            <div class="card-text px-3">
                                <h4 class="card-title mt-3">{{$blog->title}}</h4>
                                <p>{!!str_limit($blog->body, 150, '....')!!}</p>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <small><i class="fa fa-clock-o pr-2"></i>{{$blog->created_at}}</small>
                            <a href="/blogs/{{$blog->id}}" class="btn btn-info btn-sm float-right" role="button">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No posts found</p>
        @endif
    </div>
</div>


@endsection