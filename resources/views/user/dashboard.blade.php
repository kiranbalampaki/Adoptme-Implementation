<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>User Panel</title>

  <!-- Custom styles for this template-->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="{{asset('css/admin.min.css')}}" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fa fa-paw"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ Auth::user()->firstname }}</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="/">
          <i class="fa fa-home"></i>
          <span>Go to Home</span></a>
      </li>

      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Interface
      </div>

      <li class="nav-item">
        <a class="nav-link" href="../user">
          <i class="fa fa-user"></i>
          <span>Profile</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlog" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-dog"></i>
          <span>Pets</span>
        </a>
        <div id="collapseBlog" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pet Utilities</h6>
            <a class="collapse-item" href="{{route('pets.create')}}"><i class="fa fa-plus pr-2"></i>Add a pet</a>
            <a class="collapse-item" href="../user/petindex"><i class="fas fa-cat pr-2"></i>My Pets</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="../user/purchases">
          <i class="fa fa-tags"></i>
          <span>Purchases</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('stories.create') }}">
          <i class="fa fa-comments"></i>
          <span>Adoption Story</span></a>
      </li>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
<li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">{{ \App\Message::where('is_read','0')->count()}}</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                @if(count($messages)>0)
                @foreach ($messages as $message)
                  <a class="dropdown-item d-flex align-items-center" href="/messages/{{$message->channel_id}}">
                    <div class="dropdown-list-image mr-3">
                      <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    </div>
                    <div class="">
                      
                      @if(\App\Message::where(['channel_id' => $message->channel_id])->where('is_read','=','false')->count() > 0)
                      <div class="text-truncate font-weight-bold">{{ \App\Message::where(['channel_id' => $message->channel_id])->pluck('message')->last() }}</div>
                      @else
                      <div class="text-truncate">{{ \App\Message::where(['channel_id' => $message->channel_id])->pluck('message')->last() }}</div>
                      @endif
                        
                      
                      <div class="small text-gray-500">
                      @if ($message->sender == Auth::user()->id)
                          {{ \App\User::where(['id' => $message->receiver])->pluck('firstname')->first() }}
                          {{ \App\User::where(['id' => $message->receiver])->pluck('lastname')->first() }}
                      @else
                          {{ \App\User::where(['id' => $message->sender])->pluck('firstname')->first() }}
                          {{ \App\User::where(['id' => $message->sender])->pluck('lastname')->first() }}
                      @endif
                      </div>
                    </div>
                  </a>
                @endforeach
                @endif
                <a class="dropdown-item text-center small text-gray-500" href="{{route('messages.index')}}">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->firstname }}</span>
                <?php $img = Auth::user()->profile_picture ; ?>
                @if ($img != null)
                <img class="img-profile rounded-circle" src="{{asset('assets/uploads/profilepictures/'.$img)}}">
                @else
                <img class="img-profile rounded-circle ml-5" src="https://image.flaticon.com/icons/svg/145/145843.svg">
                @endif
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
        @include('flash-message')
        @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">Logout</button>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin.min.js') }}"></script>
    <script>
    CKEDITOR.replace( 'summary-ckeditor' );
    </script>

</body>

</html>