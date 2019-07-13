@extends('user.dashboard')

@section('content')
<h2 class="text-center py-2">Your Purchases</h2>
<div class="container">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-sm table-hover table-bordered">
            
                @if (count($purchases)>0)
                <thead class="thead-dark text-center">
                    <tr>
                        <th>SN.</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Rate</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Payment Method</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $purchase)
                    <?php $img = $products->where('id', $purchase->product_id)->pluck('product_image')->first(); ?>
                    <tr>
                        <td>1</td>
                        <td>{{ $products->where('id', $purchase->product_id)->pluck('product_name')->first() }}</td>
                        <td><img src="{{asset('assets/uploads/products/'.$img)}}" height="100"></td>
                        <td>{{ $products->where('id', $purchase->product_id)->pluck('price')->first() }}</td>
                        <td>{{$purchase->quantity}}</td>
                        <td>{{$purchase->price}}</td>
                        <td>{{ucfirst($purchase->payment_option)}}</td>
                        <td>{{date_format($purchase->created_at,"Y/m/d H:i:s")}}</td>
                    </tr>                        
                </tbody>
                @endforeach
                @else
                    <div class="mx-auto mt-5" style="background:url({{asset('assets/landingimages/nosales.png')}});background-position:center;background-size:cover;height:220px; width:220px;"></div>
                    <p class="text-center">No Purchases</p>
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