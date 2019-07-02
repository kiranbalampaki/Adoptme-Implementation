@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <div class="container">
        <div class="row text-justify">
            {{-- main --}}
            <div class="col-9 col-sm-9 col-xs-8">
                <div class="row">
                    {{-- pet --}}
                    <div class="col-md-6 mb-4">
                        <img src="../assets/uploads/products/{{$product->product_image}}" class="img-fluid" style="width:100%;" alt="">
                    </div>
                    {{-- pet detail --}}
                    <div class="col-md-6 mb-4">
            
                        <div class="p-4">
                            <p class="lead font-weight-bold">{{$product->product_name}}</p>

                            <p>price</p><hr>

                            <div class="row mx-1">
                            </div>

                            <div class="mt-4">
                            <a class="btn btn-primary" href="{{route('orders.edit',['id'=>$product->id])}}">Buy</a>
                            {{-- <form action="{{route('orders.create', $product->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                                {{-- <input type="text" name="first_user" value="{{Auth::user()->id}}" hidden>
                                <input type="text" name="second_user" value="{{$pet->user_id}}" hidden>
                                <input type="text" name="pet_id" value="{{$pet->id}}" hidden> --}}
                                {{-- <button class="btn btn-primary" type="submit">Buy</button> --}}
                                </form>
                            </div>
                        </div>
                        
                    </div>
                    {{-- <a href="/pets">Go Back</a><br>
                    <img class="img-fluid mt-2" style="width: 100%; height: 20vw; object-fit: cover;" src="../assets/uploads/pets/{{$pet->pet_photo}}">
                    
                    <div class="px-2">
                        <h1 class="mt-3" style="font-size:2.5vw; font-weight:bold;">{{$pet->name}}</h1>                
                        <small><i class="fa fa-clock-o pr-2"></i>{{$pet->created_at}}</small>
                        <p>{!!$pet->details!!}</p>
                    </div> --}}
                </div>
                
            </div>
            {{-- main --}}

            <div class="col-3 col-sm-3 col-xs-4 bg-secondary p-3">
                <div><h5 class="text-light text-center">More</h5></div>
                <hr>
            </div>

        </div>
    </div>
</div>
@endsection