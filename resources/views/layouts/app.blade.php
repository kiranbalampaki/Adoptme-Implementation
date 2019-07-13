<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
    

    <title>{{config('app.name', 'ADOPTME')}}</title>

    <style>
        body{
            background-color:white;
        }

        .navbar-nav .active{
            border-bottom:5px solid #55dcd6;
        }

        .navbar-nav a{
            min-width:65px;
            letter-spacing:1px;
            text-align:center;
            text-transform:uppercase;
            color:black;
        }

        .navbar{
            font-family:Montserrat;
            font-size:12px;
            letter-spacing: 1px;
            padding-bottom:0;
        }

        .navbar-nav a:hover{
            color:#55dcd6;
            transition: all 0.3s;
        }

        .bannerbutton{
            color:#55dcd6;
            border-radius:50px;
            font-size:1.5vw;
            border:2px solid #55dcd6;
        }

        .bannerbutton:hover{
            color:white;
            background-color:#55dcd6;
        }

        .banner{
            font-family:Gotham;
            color:#666666;
            background-image : url({{asset('assets/landingimages/banner.png')}});
            background-size : cover;
            object-fit: contain;
            background-repeat:no-repeat;
            background-size:contain;
            background-position:center;
            height:90vh;
        }

        .infobanner{
            background-image : url({{asset('assets/landingimages/infobanner.png')}});
            background-repeat:no-repeat;
            background-position:center;
            object-fit: contain;
        }
        
        .petcard .overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        width: 100%;
        opacity: 0;
        transition: .5s ease;
        background-color: #55dcd6;
        }

        .petcard:hover .overlay {
        opacity: 1;
        }

        .productcard .overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        width: 100%;
        opacity: 0;
        transition: .5s ease;
        background-color: #55dcd6;
        }

        .productcard:hover .overlay {
        opacity: 1;
        }

        .cart-button{
            width:120px;
            background-color:black;
            border-radius:50px;
        }

        .cart-button:hover{
            color:#55dcd6;
        }
        .cart-items {
            position: relative;
            overflow-y: scroll;
            overflow-x: hidden;
            height: 300px;
        }
        /* width */
.cart-items::-webkit-scrollbar {
  width: 2px;
}

/* Track */
.cart-items::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
.cart-items::-webkit-scrollbar-thumb {
  background: #55dcd6; 
}

/* Handle on hover */
.cart-items::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>

</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top shadow-sm bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{asset('assets/landingimages/logo/logo.png')}}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pets.index')}}">Pets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index')}}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blogs.index')}}">Blogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/help">How It Works</a>
                </li>     
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>   
                @if (Auth::guest())
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            {{-- <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li> --}}
                @else
                            <li class="dropdown">
                                <a class="nav-link" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->firstname }}<span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu" style="left:auto; right:0;">
                                @if(Auth::user()->user_type == 'admin')
                                    <li><a class="nav-link" href="{{ route('admin.index') }}">Dashboard</a></li>
                                @else
                                    <li><a class="nav-link" href="{{ route('user.index') }}">Dashboard</a></li>
                                @endif
                                    
                                    <li>
                                        <a class="nav-link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                @endif
                        
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#" id="essenceCartBtn"><i class="fa fa-shopping-cart fa-2x"></i></a>
                </li> --}}
            </ul>
            </div>
                {{-- <a class="nav-link" href="#" id="essenceCartBtn"><i class="fa fa-shopping-cart fa-2x"></i></a> --}}
        </div>
    </nav>
    
    <button id="essenceCartBtn"><i class="fa fa-shopping-cart"></i><span>3</span></button>

    <div class="right-side-cart-area p-3">
        <div class="p-5">
            <div class="row my-auto">
                <h5>YOUR CART</h5>
                <a class="ml-auto mr-5" style="cursor:pointer;" id="rightSideCart"><i class="fa fa-times" style="font-size:20px;"></i></a>
            </div>

            <div class="cart-items mt-5">
                <div class="row">
                    <div>
                        <img class="img-fluid" style="width: 80px; height: 100px; object-fit: cover;" src="assets/uploads/products/" alt="">
                    </div>
                    <div class="ml-4">
                        <p class="mt-1">Product Name</p>
                        <p style="color:grey">1 x 300</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <img class="img-fluid" style="width: 80px; height: 100px; object-fit: cover;" src="assets/uploads/products/" alt="">
                    </div>
                    <div class="ml-4">
                        <p class="mt-1">Product Name</p>
                        <p style="color:grey">1 x 300</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <img class="img-fluid" style="width: 80px; height: 100px; object-fit: cover;" src="assets/uploads/products/" alt="">
                    </div>
                    <div class="ml-4">
                        <p class="mt-1">Product Name</p>
                        <p style="color:grey">1 x 300</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <img class="img-fluid" style="width: 80px; height: 100px; object-fit: cover;" src="assets/uploads/products/" alt="">
                    </div>
                    <div class="ml-4">
                        <p class="mt-1">Product Name</p>
                        <p style="color:grey">1 x 300</p>
                    </div>
                </div>
            </div>

            <div class="mt-3">
            <h4>Total: Rs 500</h4>
            </div>

            <div class="row mt-5">
                <button class="btn btn-dark cart-button">View Cart</button>
                <button class="btn btn-dark cart-button ml-auto">Check Out</button>
            </div>
        </div>
    </div>
    {{-- <div class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><i class="fa fa-arrow-right"></i></a>
        </div>

        <div class="cart-content d-flex">

            <!-- Cart List Area -->
            <div class="cart-list">
                <!-- Single Cart Item -->
                <div class="single-cart-item">
                    <a href="#" class="product-image">
                        <img class="card-img-top img-fluid" style="width: 100%; height: 15vw; object-fit: cover;" src="assets/uploads/blogimages/{{$blog->blog_image}}" alt="">
                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                          <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                            <h6>Product Name</h6>
                            <p>Description</p2>
                            <p class="price">$45.00</p>
                        </div>
                    </a>
                </div>


            </div>

            <!-- Cart Summary -->
            <div class="cart-amount-summary">

                <h2>Summary</h2>
                <ul class="summary-table">
                    <li><span>Number of items:</span> <span>3</span></li>
                    <li><span>total:</span> <span>$232.00</span></li>
                </ul>
                <div class="mt-5">
                    <button class="btn btn-secondary btn-lg">Check Out</button>
                    <button class="btn btn-secondary btn-lg ml-5">Check Out</button>
                </div>
            </div>
        </div>
    </div> --}}

    @include('flash-message')
    @yield('content')

    <section class="bg-light py-2">
        <div class="container-fluid text-center text-white">
            <a class="navbar-brand" href="#">
                <img src="{{asset('assets/landingimages/logo/logo.png')}}" alt="">
            </a><br>
            <span class="fa-2x" style="color:#CCCCCC;">
                <i class="fa fa-instagram mx-2"></i>
                <i class="fa fa-facebook mx-2"></i>
                <i class="fa fa-twitter mx-2"></i>
                <i class="fa fa-rss mx-2"></i>
                <i class="fa fa-youtube mx-2"></i>
            </span>
        <hr>
        <p style="color:grey;">© 2018 Copyright : Kiran Balampaki</p>
        </div>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('js/active.js') }}"></script>
    <script>
    CKEDITOR.replace( 'summary-ckeditor' );
    </script>

</body>
</html>