@extends('admin.dashboard')

@section('content')
<h2 class="text-center py-2">Your Sales</h2>
<div class="container">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-sm table-hover table-bordered">

                @if (count($purchases)>0)
                <thead class="thead-dark text-center">
                    <tr>
                        <th>S.N.</th>
                        <th>User</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($purchases)>0)
                    <?php $i=1; ?>
                    @foreach ($purchases as $purchase)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{ $users->where('id', $purchase->user_id)->pluck('firstname')->first() }} {{ $users->where('id', $purchase->user_id)->pluck('lastname')->first() }}</td>
                        <td>{{ $products->where('id', $purchase->product_id)->pluck('product_name')->first() }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>{{ $purchase->price }}</td>
                        <td>{{ $purchase->created_at }}</td>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                    @else
                    <p>No Sales</p>
                    @endif
                </tbody>
                @else
                    <div class="mx-auto mt-5" style="background:url({{asset('assets/landingimages/nosales.png')}});background-position:center;background-size:cover;height:300px; width:300px;"></div>
                    <p class="text-center">No Sales</p>
                @endif       
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