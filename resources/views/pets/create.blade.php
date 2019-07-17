@extends('user.dashboard')

@section('content')
<div class="card card border-left-primary shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add Pet</h6>
                </div>
<div class="card-body">

 <form method="POST" action="{{route('pets.store')}}" enctype="multipart/form-data">
    <div class="form-group row">
        <div class="col-4">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name">
        </div>
        <div class="col-4">
                    <label for="breed">Pet's Breed</label>
                    <input class="form-control p-1 col-8" type="text" name = "breed">
        </div>
        <div class="col-4">
                    <label for="image">Pet's Photo</label>
                    <input class="form-control p-1 col-8" type="file" name = "image">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-3">
            <label for="type">Type</label><br>
            <input type="radio" name="type" value="dog"> Dog
            <input type="radio" name="type" value="cat" class="ml-3"> Cat<br>       
        </div>
        <div class="col-3">
            <label for="gender">Gender</label><br>
            <input type="radio" name="gender" value="m"> Male
            <input type="radio" name="gender" value="f" class="ml-3"> Female<br>       
        </div>        
    </div>
    <div class="form-group row">
        <div class="col-3">
            <label for="age">Age</label>
            <select class="form-control" name="age">
            <option value="young">Young</option>
            <option value="adult">Adult</option>
            <option value="senior">Senior</option>
            </select>
        </div>
        <div class="col-3">
            <label for="size">Size</label>
            <select class="form-control" name="size">
            <option value="small">Small</option>
            <option value="medium">Medium</option>
            <option value="large">Large</option>
            <option value="extra large">Extra Large</option>
            </select>
        </div>
        <div class="col-3">
            <label for="color">Color</label>
            <select class="form-control" name="color">
            <option value="black">Black</option>
            <option value="white">White</option>
            <option value="brown">Brown</option>
            <option value="grey">Grey</option>
            <option value="multicolor">Multicolor</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-3">
            <input type="checkbox" name="is_vaccinated" value="TRUE"> Vaccinated    
        </div>
        <div class="col-3">
            <input type="checkbox" name="is_dewormed" value="TRUE"> Dewormed
        </div>        
    </div>
    <div class="form-group">
        <label for="details">Details</label>
        <textarea class="form-control" id="summary-ckeditor" name="details"></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Add Pet</button>
    @csrf
    {{-- <label for="classs">Class</label>
		<select class="form-control" id="classes" name="classes">
		  <option value="acting">Acting</option>
		  <option value="singing">Singing</option>
		  <option value="dancing">Dancing</option>
		</select> --}}
 </form>
 </div>
 </div>
@endsection