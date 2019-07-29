@extends('user.dashboard')

@section('content')
<style>

</style>
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-home fa-sm text-white-50"></i> Go to Home</a>
          </div>

<div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-4 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pets Posted for Adoption</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Pet::where(['user_id' => Auth::user()->id])->count() }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dog fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-4 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Successful Adoptions</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Pet::where(['user_id' => Auth::user()->id])->where('is_adopted','=',TRUE)->count() }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-smile fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {{-- <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-4 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Trainings Booked</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Pet::where(['user_id' => Auth::user()->id])->where('is_adopted','=',TRUE)->count() }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dumbbell fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}

            <!-- Pending Requests Card Example -->
            <div class="col-xl-4 col-md-4 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Items Bought</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Order::where(['user_id' => Auth::user()->id])->count() }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-tags fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</div>

<div class="row">
             <div class="col-xl-8 col-lg-7">
              <div class="border-left-primary card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                </div>
                <!-- Card Body -->
                <div class="row my-4">
                        <?php $img = Auth::user()->profile_picture ; ?>
                        @if ($img != null)
                        <img class="img-profile rounded-circle ml-5" src="{{asset('assets/uploads/profilepictures/'.$img)}}">
                        @else
                        <img class="img-profile rounded-circle ml-5" src="https://image.flaticon.com/icons/svg/145/145843.svg">
                        @endif
                        <div class="ml-4">
                          <h2 style="color:black;">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h2>
                          <p class="mt-3">{{ Auth::user()->email }}</p>
                          <p>Member Since : {{ date('d F, Y', strtotime(Auth::user()->created_at)) }}</p>
                        </div>
                        <div class="ml-5">
                        <a href="{{route('user.edit',['id'=>Auth::user()->id])}}" class="btn btn-sm btn-primary shadow-sm">Edit Profile</a>
                        </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Purchase History</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                      <div class="mx-auto" style="background:url({{asset('assets/landingimages/nosales.png')}});background-position:center;background-size:cover;height:220px; width:220px;"></div>
                      <p class="text-center">No Purchases</p>
                </div>
              </div>
            </div>
          </div>


</div>


@endsection