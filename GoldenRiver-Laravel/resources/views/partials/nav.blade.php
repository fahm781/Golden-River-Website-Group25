<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{asset('images/favicon.jpg')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>

<header>
    <!--ver1:
    <div class="completenavbar">
        <a href="/" class="navbar__image"><img class="gr" src="{{asset('images/logo.png')}}" width="150px"></a>
        <div class="navbar__navsection">
            <div class="completenavbar">
                <a href="{{ url('/') }}" class="navbar_item">Home</a>
                <a href="{{ url('/product') }}" class="navbar_item">Shop</a>
                <a href="{{ url('/aboutus') }}" class="navbar_item">About Us</a>
                <a href="{{ url('/contact') }}" class="navbar_item">Contact Us</a>

                @auth
                <a href="{{ url('/cart') }}" class="navbar_item">Basket({{ \App\Models\Order::basketTotal() }})</a>
                <a href="{{ url('/profile') }}" id="username" class="navbar_item">{{ Auth::user()->name }}</a>
                <a href="{{ url('/logout') }}" class="navbar_item">Log Out</a>
                @endauth

                @guest
                <a href="{{ url('/login') }}" class="navbar_item">Log In</a>
                <a href="{{ url('/userRegistration') }}" class="navbar_item">Sign Up</a>
                @endguest
            </div>
        </div>
    </div>
    -->

    <nav class="navcontainer">
		<div class="logo">
			<img src="{{asset('images/logo.png')}}" alt="Logo">
		</div>
		<ul class="menu">
			<li><a href="{{ url('/') }}" class="navbar_item">Home</a></li>
            <li><a href="{{ url('/product') }}" class="navbar_item">Shop</a></li>
            <li><a href="{{ url('/aboutus') }}" class="navbar_item">About Us</a></li>
            <li><a href="{{ url('/contact') }}" class="navbar_item">Contact Us</a></li>

            @auth
            <li><a href="{{ url('/cart') }}" class="navbar_item">Basket({{ \App\Models\Order::basketTotal() }})</a></li>
            <li><a href="{{ url('/profile') }}" id="username" class="navbar_item">{{ Auth::user()->name }}</a></li>
            <li><a href="{{ url('/logout') }}" class="navbar_item">Log Out</a></li>
            @endauth

            @guest
            <li><a href="{{ url('/login') }}" class="navbar_item">Log In</a></li>
            <li><a href="{{ url('/userRegistration') }}" class="navbar_item">Sign Up</a></li>
            @endguest
			
		</ul>

    </nav>


</header>

<div>
    @yield('body')
<div>
    @include('partials.footer')
</div>
</div>