@extends('layouts.app')

@section('content')
<div class="container-fluid row">
    <div class="col-8">
        <table id="cart" class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th style="width:50%">Product</th>
                    <th style="width:10%">Price</th>
                    <th style="width:8%">Quantity</th>
                    <th style="width:18%" class="text-center">Subtotal</th>
                    <th style="width:14%"></th>
                </tr>
                </thead>
                <tbody>
        
                <?php $total = 0 ?>
        
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
        
                        <?php $total += $details['price'] * $details['quantity'] ?>
        
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-sm-3 hidden-xs"><img src="assets/uploads/products/{{ $details['photo'] }}" width="100" height="100" class="img-responsive"/></div>
                                    <div class="col-sm-9">
                                        <h4 class="nomargin">{{ $details['name'] }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Price">Rs. {{ $details['price'] }}</td>
                            <td data-th="Quantity">
                                <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" />
                            </td>
                            <td data-th="Subtotal" class="text-center">Rs. {{ $details['price'] * $details['quantity'] }}</td>
                            <td class="actions" data-th="">
                                <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                                <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>
                    @endforeach
                @endif
        
                </tbody>
                <tfoot>
                <tr class="visible-xs">
                    <td class="text-center"><strong>Total {{ $total }}</strong></td>
                </tr>
                <tr>
                    <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Total Rs. {{ $total }}</strong></td>
                </tr>
                </tfoot>
        </table>
    </div>
    
    <div class="col-4 p-5">
        <div>
            <h3 class="text-center">CHECKOUT FORM</h3><hr>

            <form method="POST" action="{{route('orders.store')}}">
            <div class="row mt-4">
                <div class="col-6">
                    <h5>Full Name:</h5>
                </div>
                <div class="col-6">
                    @if (Auth::guest())
                    <input class="chkoutinput" type="text">
                    @else
                    <h5>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h5>
                    @endif
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-6">
                    <h5>Address:</h5>
                </div>
                <div class="col-6">
                    <input class="chkoutinput" type="text">
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-6">
                    <h5>Contact No.:</h5>
                </div>
                <div class="col-6">
                    <input class="chkoutinput" type="text" onkeypress='validate(event)' />
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-6">
                    <h5>Contact No.(alt):</h5>
                </div>
                <div class="col-6">
                    <input class="chkoutinput" type="text" onkeypress='validate(event)' />
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-6">
                    <h5>Payment Method:</h5>
                </div>
                <div class="col-6">
                    <select class="form-control" name="payment_option">
                        <option value="esewa">Esewa</option>
                        <option value="khalti">Khalti</option>
                        <option value="paypal">Paypal</option>
                    </select>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-6">
                    <h5>Total:</h5>
                </div>
                <div class="col-6">
                    <h5>Rs. {{ $total }}</h5>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-dark cart-button-lg mt-5">CHECKOUT</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
 
        $(".update-cart").click(function (e) {
           e.preventDefault();
 
           var ele = $(this);
 
            $.ajax({
               url: '{{ url('update-cart') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });
 
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
 
            var ele = $(this);
 
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
 
</script>

<script>
function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>
@endsection