@extends('admin.dashboard')

@section('content')
<h2 class="text-center py-2">Products</h2>
<div class="container">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-sm table-hover table-bordered" style="font-size:13px">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($products)>0)
                    <?php $i=1; ?>
                    @foreach ($products as $product)
                    <?php $img = $product->product_image; ?>
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>
                            <img src="{{asset('assets/uploads/products/'.$img)}}" height="50">                            
                        </td>
                        <td>Rs. {{$product->price}}</td>
                        <td>{{$product->stock}}</td>
                        <td class="text-justify">{!!str_limit($product->description, 250, '....')!!}...</td>
                        <td>{{ $categories->where('id', $product->category_id)->pluck('category_name')->first() }}</td>
                        <td class="text-center align-middle">
                        <div class="btn-group">
                            <a href="{{route('products.edit',['id'=>$product->id])}}" class="btn btn-primary btn-sm mr-2"><i class="fa fa-pencil"></i></a>
                            <form action="{{ route('products.destroy',['id'=>$product->id]) }}" method="POST">
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
                    <p>No Products</p>
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
@endsection