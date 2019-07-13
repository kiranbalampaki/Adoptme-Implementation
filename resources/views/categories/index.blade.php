@extends('admin.dashboard')

@section('content')
{{-- <div class="row">
    <div class="col-6">
        <div class="card card border-left-primary shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Categories</h6>
            </div>
        <div class="card-body">

        <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
            <div class="form-group">
                <div class="">
                    <label for="name">Category Name</label>
                    <input class="form-control" type="text" name="name">
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Add Category</button>
            @csrf
        </form>
    </div>

    <div class="col-6">
    asdfsadf
    </div>
</div> --}}
<div class="row">
             <div class="col-xl-8 col-lg-7">
              <div class="border-left-primary card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Product Categories</h6>
                </div>
                <!-- Card Body -->
            <div class="col-md-12 table-responsive mt-3">
            <table class="table table-sm table-hover table-bordered">
                <thead class=" text-center">
                    <tr>
                        <th>S.N.</th>
                        <th>Category Name</th>
                        <th>Items in this Category</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($categories)>0)
                    <?php $i=1; ?>
                    @foreach ($categories as $category)
                    <tr>
                        <td class="text-center">{{$i}}</td>
                        <td>{{$category->category_name}}</td>
                        <td class="text-center">{{ \App\Product::where(['category_id' => $category->id])->count() }}</td>
                        <td class="text-center align-middle">
                        <div class="btn-group">
                            <form action="{{ route('categories.destroy',['id'=>$category->id]) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                        </td>
                    </tr>
                    <?php $i++; ?>                
                    @endforeach
                    @else
                    <p>no categories</p>
                    @endif
                </tbody>
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
                <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
                <script>
                    $(".table").DataTable();
                </script>
            </table>
        </div>
              </div>
            </div>

                         <div class="col-xl-4 col-lg-5">
              <div class="border-left-info card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Add Categories</h6>
                </div>
                <!-- Card Body -->
                <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data" class="p-3">
            <div class="form-group">
                <div class="">
                    <label for="name">Category Name</label>
                    <input class="form-control" type="text" name="name">
                </div>
            </div>
            <button class="btn btn-primary float-right" type="submit">Add Category</button>
            @csrf
        </form>
              </div>
            </div>



</div>
@endsection