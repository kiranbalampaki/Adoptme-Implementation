@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <div class="">
        <div class="row text-justify">
            {{-- main --}}
            <div class="col-9 col-sm-9 col-xs-8">
                <div class="row">
                    {{-- pet --}}
                    <div class="col-md-6 mb-4">
                        <img src="../assets/uploads/pets/{{$pet->pet_photo}}" class="img-fluid" style="width:100%;" alt="">
                    </div>
                    {{-- pet detail --}}
                    <div class="col-md-6 mb-4">
            
                        <div class="p-4">
                            <p class="lead font-weight-bold">{{$pet->name}}</p>

                            <p>
                                {{$pet->breed}}
                                @if($pet->gender=='m')
                                    <i class="fa fa-mars ml-4 pr-1"></i> Male
                                @else
                                    <i class="fa fa-venus ml-4 pr-1"></i> Female
                                @endif
                                <hr>
                                {{$pet->age}}&ensp;&ensp;•&ensp;&ensp;{{$pet->size}}&ensp;&ensp;•&ensp;&ensp;{{$pet->color}}
                            </p><hr>

                            <div class="row mx-1">
                                <div class="col-6">
                                        @if($pet->is_vaccinated=='1')
                                                <i class="fa fa-check" style="color:lightgreen;"></i>
                                        @else
                                                <i class="fa fa-times" style="color:red;"></i>
                                        @endif
                                        Vaccinated
                                </div>
                                <div class="col-6">
                                        @if($pet->is_dewormed=='1')
                                                <i class="fa fa-check" style="color:lightgreen;"></i>
                                        @else
                                                <i class="fa fa-times" style="color:red;"></i>
                                        @endif
                                        Dewormed
                                </div>
                            </div>

                            <div class="mt-4">
                            <form action="{{route('channels.store')}}" method="POST">
                            {{ csrf_field() }}
                                <input type="text" name="first_user" value="{{Auth::user()->id}}" hidden>
                                <input type="text" name="second_user" value="{{$pet->user_id}}" hidden>
                                <input type="text" name="pet_id" value="{{$pet->id}}" hidden>
                                <button class="btn btn-primary" type="submit">Ask about {{$pet->name}}</button>
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
                
                <div class="pr-4"><hr>
                <p>{!!$pet->details!!}</p>
                </div>
            </div>
            {{-- main --}}

            <div class="col-3 col-sm-3 col-xs-4 p-3" style="border-left: 1px solid #ddddef">
                <div><h3 class="font-weight-bold text-center">More</h3></div>
                <hr>
                @foreach($allpets as $pet)
                <a href="/pets/{{$pet->id}}" id="unstyled-link">
                    <div class="row">
                        <div class="col-6 m-0">
                            <img class="" style="width: 100%; height: 5vw; object-fit: cover;" src="../assets/uploads/pets/{{$pet->pet_photo}}" alt="">
                        </div>
                        <div class="col-6 p-0 pr-3">
                            <h6 class="card-title font-weight-bold m-0">{{$pet->name}}</h6>
                            <small>{{ $pet->breed }}</small><br>
                            <small>@if($pet->gender=='m') Male @else Female @endif | {{ $pet->age }} | {{ $pet->size }}</small>
                        </div>
                    </div>
                    </a>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection