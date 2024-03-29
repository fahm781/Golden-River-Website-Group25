@extends('partials.nav')

@section('css')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/shop.css')}}">
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="\tableCSS\css\style.css">
<title>GoldenRiver | Profile</title>
@endsection

@section('body')
<div style="text-align: center; ">
    @if(Auth::check())

    @if (session('message'))
    <div>
        <h2>{{ session('message') }}</h2>
        <h1>Welcome, {{ Auth::user()->name }}</h1>
    </div>
    @endif

    <h1 class="basketheader">Account</h1>

    <div class="reg__container form-box">
        <div class="margin_space">
            Update Your Information
        </div>
        <form method="POST" action="{{ route('user.update.name.email', Auth::user()->id) }}">
            @csrf
            <!-- Update Name and Email -->
            <div class="form__input-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" required autofocus maxlength="30" class="form__input" placeholder="Change your name...">
                <div id="name-error"></div>
            </div>
            <div class="form__input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" required maxlength="30" class="form__input" placeholder="Change your email...">

                <div id="email-error"></div>
            </div>
            <div class="form__input-group">
                <button type="submit" name="update_emailname" class="form__button">Update!</button>
            </div>

            <div class="error">
                @error('email')
                {{$message}}
                @enderror
            </div>

        </form>

        @if(session('status'))
        <div class="onClickMessageForm1">
            {{ session('status') }}
        </div>
        @endif
    </div>

    <div class="reg__container form-box">
        <div class="margin_space">
            Update Your Password
        </div>
        <form method="POST" action="{{ route('user.update.password', Auth::user()->id) }}">
            @csrf
            <!-- Update Password Only -->
            <div class="form__input-group">
                <label for="password">New Password</label>
                <input type="password" name="password" id="password" class="form__input">
            </div>
            <div class="form__input-group">
                <label for="password-confirm">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password-confirm" class="form__input">
                <div id="error-message"></div>
            </div>
            <div class="form__input-group2">
                <button id="update-password-button" type="submit" name="update_password" disabled class="form__button">Update!</button>
            </div>
        </form>
        @if (session('password_status'))
        <div class="onClickMessageForm2">
            {{ session('password_status') }}
        </div>
        @endif
    </div>


    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1 class="h5 mb-4 text-center">View Recent Orders</h1>
                    <div class="table-wrap">

                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Ordered on</th>
                                    <th>Status</th>
                                    <th>More Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($orders) && $orders->count() > 0)
                                @php $prevOrderID = null; @endphp
                                @foreach($orders as $order)
                                @if($order->Order_ID != $prevOrderID)
                                <tr>
                                    <td>{{$order->Order_ID}}</td>
                                    <td class="textOnLeft">{{date('d-m-Y', strtotime($order->created_at))}}</td>
                                    <td class="status">
                                        <span>Status:</span>
                                        <span class="status-label {{ $order->Order_Status == 'Shipped' ? 'shipped' : 
                                     ($order->Order_Status == 'Delivered' ? 'delivered' : 
                                      ($order->Order_Status == 'Canceled' ? 'canceled' : 'default')) }}">
                                            {{ $order->Order_Status }}
                                        </span>

                                    </td>
                                    <td><a href="{{ route('orders.show', ['id' => $order->Order_ID]) }}">View More</a></td>
                                </tr>

                                @php $prevOrderID = $order->Order_ID; @endphp
                                @endif
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4">You haven't made any orders yet. Click <a href="/product" class="shopNowCSS">here</a> to start shopping!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    @else

    @if(session('success'))
    <div class="alert alert-success"><br><br><br><br><br>
        <h1> {{ session('success') }} </h1>
    </div>

    @endif
    <br>
    <p>{{ __('Please login again to view your information and orders!') }}</p>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    @endif

    <script src="{{ asset('js/passwordAuthentication.js') }}"></script>
    <script src="{{ asset('js/nameEmailAuthentication.js') }}"></script>
    @endsection