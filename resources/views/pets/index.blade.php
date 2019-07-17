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
<h2 class="font-weight-bold">Pets</h2>
  <div class="row mt-5">
    <div class="col-3">
      <form method="GET" action="pets">
          <div class="form-group row">
              <div class="col-12">
                  <label for="type">Type</label><br>
                  <input type="radio" name="type" value="dog"> Dog [{{ $pets->where('type', "dog")->count('id') }}]
                  <input type="radio" name="type" value="cat" class="ml-3"> Cat [{{ $pets->where('gender', "cat")->count('id') }}]
              </div>
          </div>
          <hr>
          <div class="form-group row">
              <div class="col-12">
                  <label for="gender">Gender</label><br>
                  <input type="radio" name="gender" value="m"> Male
                  <input type="radio" name="gender" value="f" class="ml-3"> Female
              </div>        
          </div>
          <hr>
          <div class="form-group row">
              <div class="col-12">
                  <label for="age">Age</label><br>
                  <input type="checkbox" name="age" value="young"> Young
                  <input type="checkbox" name="age" value="adult" class="ml-3"> Adult
                  <input type="checkbox" name="age" value="senior" class="ml-3"> Senior
              </div>
          </div>
          <hr>
          <div class="form-group row mt-4">
              <div class="col-12">
                  <label for="size">Size</label><br>
                  <input type="checkbox" name="size" value="small"> Small<br>
                  <input type="checkbox" name="size" value="medium"> Medium<br>
                  <input type="checkbox" name="size" value="large"> Large<br>
                  <input type="checkbox" name="size" value="extra large"> Extra Large<br>
              </div>
            </div>
            <hr>
            <div class="form-group row mt-4">
              <div class="col-12">
                  <label for="color">Color</label><br>
                  <input type="checkbox" name="color" value="black"> Black<br>
                  <input type="checkbox" name="color" value="white"> White<br>
                  <input type="checkbox" name="color" value="brown"> Brown<br>
                  <input type="checkbox" name="color" value="grey"> Grey<br>
                  <input type="checkbox" name="color" value="multicolor"> Multicolor<br>
              </div>
          </div>
          <hr>
          {{-- <div class="form-group row">
              <div class="col-12">
                  <input type="checkbox" name="is_vaccinated" value="TRUE"> Vaccinated    
              </div>
          </div>
          <div class="form-group row">
              <div class="col-12">
                  <input type="checkbox" name="is_dewormed" value="TRUE"> Dewormed
              </div>        
          </div> --}}
          <button class="btn btn-primary" type="submit">Search</button>

      </form>
    </div>

    <div class="col-9">
      <div class="row">
          @foreach($pets as $pet)
              <div class="col-12 col-sm-8 col-md-6 col-lg-3 mb-5 p-1">
                  <div class="card">
                      <img class="card-img mt-3 mx-auto" style="width: 90%; height: 15vw; object-fit: cover;" src="../assets/uploads/pets/{{$pet->pet_photo}}" alt="">
                      <div class="overlay">
                          <div class="cartbutton text-right mt-3 mr-3">
                              <a href="/pets/{{$pet->id}}" class="btn btn-primary btn-md"><i class="fa fa-search"></i></a>
                          </div>
                      </div>
                      <div class="card-body">
                      <hr>
                      <p class="card-subtitle mb-2 text-muted" style="font-size:12px"><a href="/" id="unstyled-link">{{ $pet->breed }}</a></p>
                      <p class="card-title font-weight-bold"><a href="/pets/{{$pet->id}}" id="unstyled-link">{{$pet->name}}</a></p>
                      <p class="card-title">
                        <?php
                            if ($pet->gender == "m"){
                              echo "Male";
                            }
                            else{
                              echo "Female";
                            }
                        ?>
                        | {{$pet->age}} | {{$pet->size}} | {{$pet->color}}</p>
                      {{-- <a href="/" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a> --}}
                      </div>
                  </div>
                  </div>
          @endforeach
      </div>
        <div class="mt-4">{{$pets->links()}}</div>
    </div>
  </div>
</div>
<script>
</script>
@endsection