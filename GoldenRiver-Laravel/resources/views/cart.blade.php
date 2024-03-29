@extends('partials.nav')



@section('css')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<title>GoldenRiver | Cart</title>
@endsection


@section('body')

@if ($products !== null && $products->count() > 0)

@if(session()->has('loginToAddCart'))
<div class="alert alert-danger" role="alert">
    <h4>{!! session()->get('loginToAddCart') !!}</h4>
</div>
@endif




@if(session()->has('checkouterr'))
<div class="alert alert-success" role="alert" id="go-to-basket">
    {{session()->get('checkouterr')}}
</div>
@endif

@if(session()->has('cartstockmsg'))
<div class="alert alert-danger" role="alert">
    <h4>{{ session()->get('cartstockmsg') }}</h4>
    <script>
        setTimeout(function() {
            location.reload();
        }, 3000); // Reload page after 3 seconds (3000 milliseconds)
    </script>
</div>
@endif

<body>
    <section class="pagecontent">
        <div class="container">
            <br>
            <h1 class="basketheader">Shopping Cart</h1><br></br>

            <div class="row">
                <div class="col-sm-12 col-md-9">

                    <div class="ibox">
                        <div class="ibox-title">
                            <!--retrieve database info fot no. of items in cart-->
                            <span class="pull-right">(<strong>{{ \App\Models\Order::basketTotal() }}</strong>) items</span>
                            <h5>Items in your cart</h5>
                        </div><br>
                        @foreach($products as $product)

                        <div class="table-responsive">
                            <table class="table shoping-cart-table">
                                <tbody>
                                    <tr>
                                        <!-- Productr Img here -->
                                        <td width="90">
                                            <img src="/images/allProductImages/{{$product->Product_ID}}.jpg" alt="productImage" width="130" height="180">
                                        </td>
                                        <td class="desc">
                                            <h3>
                                                <!-- Item Name -->
                                                <a href="{{ url('/product/'.$product->Product_ID) }}" class="text-navy">{{ $product->Product_Name }}</a>
                                            </h3>
                                            <dl class="small m-b-none">
                                                <!--retrieve database info for product description-->
                                                <dt>Description: {{ $product->Description }}</dt>
                                                <!--retrieve database info for product Quantity-->
                                                <dd>Quantity: x{{ $product->pivot->Amount }}</dd>
                                                <dd>Individual Price: £{{ number_format($product->Product_Price, 2) }}
                                            </dl>

                                            <div class="m-t-sm">
                                                <!-- allow item deletion -->
                                                <a href="{{ url('/removefrombasket/'.$product->Product_ID) }}" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                            </div>
                                        </td>
                                        <!-- Product Price -->
                                        <td>
                                        <td>
                                            <h4>£{{ number_format($product->Product_Price * $product->pivot->Amount, 2) }}</h4>
                                        </td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!--table responsive closing tag -->
                        @endforeach

                    </div> <!--ibox closing tag -->

                    <div class="ibox-content">
                        <!--button onclick not working yet-->
                        <button onclick="window.location.href='{{ url('product') }}'" class="checkout__button"><i class="fa fa-arrow-left"></i> Continue shopping</button>
                    </div>
                </div> <!--column closing tag -->

                <div class="col-sm-12 col-md-3">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Cart Summary</h5>
                        </div>
                        <div class="ibox-content">
                            <hr>
                            <span class="font-bold">TOTAL</span>
                            <hr>
                            <!-- add the subtotal here -->
                            <span>£{{ $order->Order_Total_Price }}</span>

                            @php
                            $shipping = ($order->Order_Total_Price <= 90) ? $shippingCost : 0; $totalPrice=$order->Order_Total_Price + $shipping;
                                $totalText = ($shipping == 0) ? 'TOTAL WITH FREE SHIPPING' : 'TOTAL WITH SHIPPING';
                                @endphp

                                <hr>
                                <span class="font-bold">SHIPPING</span>
                                <hr>
                                <p>£{{ number_format($shipping, 2) }}</p>
                                <hr>
                                <span class="font-bold">{{ $totalText }}</span>
                                <hr>
                                <h2 class="font-bold">£{{ number_format($totalPrice, 2) }}</h2>
                                <hr>


                                <form method="post" action="{{ url('checkout') }}">
                                    @csrf
                                    <span class="font-bold">ADDRESS</span>
                                    <hr>
                                    <!--<div class="m-t-sm">-->
                                    <div>
                                        <label for="Phone_Number">Phone Number</label><br>
                                        <input type="text" name="Phone_Number" id="Phone_Number" value="{{ session()->get('user.Phone_Number') == '-' ? '' : old('Phone_Number', session()->get('user.Phone_Number')) }}" required><br>
                                        @error('Phone_Number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <label for="expiryDate">House No & Street</label><br>
                                        <input type="text" name="Street" id="Street" value="{{ $address->Street == 'pending' ? '' : old('Street', $address->Street) }}" required><br>
                                        @error('Street')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <label for="expiryDate">City</label><br>
                                        <input type="text" name="City" id="City" value="{{ $address->City == 'pending' ? '' : old('City', $address->City) }}" required><br>
                                        @error('City')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <label for="expiryDate">County</label><br>
                                        <input type="text" name="County" id="County" value="{{ $address->County == 'pending' ? '' : old('County', $address->County) }}" required><br>
                                        @error('County')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <label for="expiryDate">Country</label><br>
                                        <input type="text" name="Country" id="Country" value="{{ $address->Country == 'pending' ? '' : old('Country', $address->Country) }}" required><br>
                                        @error('Country')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <label for="expiryDate">Post Code</label><br>
                                        <input type="text" name="Post_Code" id="Post_Code" value="{{ $address->ZIP == 'pending' ? '' : old('Post_Code', $address->ZIP) }}" required><br>
                                        @error('Post_Code')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror <br><br>

                                        <div class="btn-group">
                                            <button class="checkout__button" type="submit"> Checkout</button>
                                        </div>

                                    </div> <!--address closing tag -->
                                </form>
                        </div> <!--ibox content closing tag -->
                    </div> <!--ibox closing tag -->
                </div> <!--column closing tag -->
            </div> <!--row closing tag -->
            <div>
                @else
                <br><br><br><br><br><br><br>
                <div class="empty">
                    <h1 class="basketheader">Your Cart Is Currently Empty!</h1><br><br>
                    <p>Before you proceed to checkout you must add some items to your cart</p><br>
                    <button onclick="window.location.href='{{ url('product') }}'" class="checkout__button"><i class="fa fa-arrow-left"></i>Return To Shop</button>
                </div>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                @endif
            </div> <!--php closing tag -->
        </div> <!--container closing tag -->
    </section>
</body>

@endsection
