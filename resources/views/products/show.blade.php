@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        {{-- image --}}
        <div class="col-sm-12 col-md-6 mb-2">
            <div class="row">
                <div class="col-md-4 d-none d-md-block">
                </div>
                <div class="col-12 col-md-8">
                    <img src="../assets/uploads/products/{{$product->product_image}}" class="img-fluid float-right" style="width:100%;" alt="">
                </div>
            </div>
        </div>
        {{-- description --}}
        <div class="col-sm-12 col-md-6">
            <div class="row">
                <div class="col-12 col-md-8">
                    <h4 class="font-weight-bold">{{$product->product_name}}</h4>
                    <p class="text-muted font-italic">{{ $category->category_name }}</p>

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
                            <span>
                            <u>{{ $reviews->count() }}
                            @if ($reviews->count()==1)
                            review
                            @else
                            reviews
                            @endif</u>
                            </span>
                        </div>
                    </p>

                    <p>{!!$product->description!!}</p>

                    <a href="{{ url('add-to-cart/'.$product->id) }}" class="btn btn-outline-dark btn-rounded btn-md">Add To Cart <i class="fa fa-shopping-cart ml-1"></i></i></a>
                </div>
                <div class="col-md-4 d-none d-md-block">
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="col-12">
        <h3 class="font-weight-bold text-center">Reviews</h3>
    </div>
    <div class="container mt-5">
        <div class="row text-center text-md-left">
            <div class="col-sm-12 col-md-4">
                <div class="col-sm-12 col-md-10 ml-auto">
                    @if (count($reviews->where('product_id', $product->id))>0)
                        <h5 class="font-weight-bold">Overall Rating: {{$reviews->where('product_id', $product->id)->avg('rating')}}/5</h5>

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
                            </div> 
                        </p>
                        <p style="font-size:12px;">{{$product->product_name}}, based on {{ $reviews->count() }} reviews, starting at Rs. {{$product->price}} per unit.</p>
                    @else
                    <h5 class="font-weight-bold">Overall Rating: N/A</h5>
                    <p style="font-size:12px;">Be the first one to review!</p>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-md-8">
                <div class="col-sm-12 col-md-10 mr-auto">
                    <p class="mt-3">We'd love to read your review, add this to a future delivery in order to review it.</p>
                </div>
            </div>
        </div>
        @foreach ($userreviews as $review)
        <hr>
        <div class="row">
            <div class="col-4">
                <div class="col-sm-12 col-md-10 ml-auto">

                    <?php $userrating = $review->rating ?>

                    <p>                        
                        <div>
                            @for ($i = 0; $i < 5; $i++)
                                @if($userrating>0)
                                    @if($userrating >0.5)
                                        <i class="fa fa-star"></i>
                                    @else
                                        <i class="fa fa-star-half-empty"></i>
                                    @endif
                                    @php $userrating--; @endphp
                                @else
                                    <i class="fa fa-star-o"></i>
                                @endif
                            @endfor
                        </div> 
                    </p>
                    
                    <p class="font-weight-bold m-0">Nice Product</p>
                    <small>{{ date('d F, Y', strtotime($review->created_at)) }}</small>

                </div>
            </div>
            <div class="col-8">
                <div class="col-sm-12 col-md-10 mr-autos">
                    <p class="mt-3">{{ $review->review}}</p>
                    <p class="font-weight-bold">
                    {{ \App\User::where(['id' => $review->user_id])->pluck('firstname')->first() }}
                    {{ \App\User::where(['id' => $review->user_id])->pluck('lastname')->first() }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
        <div class="mt-4 pagination-sm">{{$userreviews->links()}}</div>
    </div>
</div>
@endsection