@extends('user.dashboard')

@section('content')
<div class="card card border-left-primary shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
                </div>
<div class="card-body">
 <form method="POST" action="{{route('user.update',['id'=>$user->id])}}" enctype="multipart/form-data">
    <div class="form-group row">
        <div class="col-3">
            <label for="first_name">First Name</label>
            <input class="form-control" type="text" name="first_name" value="{{$user->firstname}}">
        </div>
        <div class="col-3">
            <label for="last_name">Last Name</label>
            <input class="form-control" type="text" name="last_name" value="{{$user->lastname}}">
        </div>
        <div class="col-3">
                    <label for="image">Profile Picture</label>
                    <input class="form-control p-1 col-8" type="file" name = "image">
        </div>
        <div class="col-3"><?php $img = $user->profile_picture; ?>
                    @if ($img!=null)
                    <img src="{{asset('assets/uploads/profilepictures/'.$img)}}" height="100">
                    @endif 
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Save</button>
    @csrf
    {{method_field('PUT')}}
 </form>
 </div>
 </div>
@endsection