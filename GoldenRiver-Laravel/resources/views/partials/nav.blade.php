<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{asset('images/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('css/general.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>GoldenRiver | Jewellery</title>
</head>
<div class="fullcontainer">
<div>
<header>
<div class="completenavbar">
    <div class="container">
    <a href="#" class="navbar__image"><img class = "gr" src = "{{asset('images/favicon.png')}}" width="150px"></a>
    <div class = "navbar__navsection">
        <div class="completenavbar">
            <a href="#" class="navbar_item">Home</a>
            <a href="#" class="navbar_item">About Us</a>
            <a href="#" class="navbar_item">Contact Us</a>
            <a href="cart.blade.php" class="navbar_item">Basket</a>
            <a href="#" class="navbar_item">Log In</a>
            <a href="#" class="navbar_item">Sign Up</a>
            <div class="navbar__dropdown">
                <button class="navbar__dropbtn">Shop</button>
                    <div class="navbar__dropdown-content">
                        <a href="#" class="navbar_item navbar_item--dropdown">Necklaces</a>
                        <a href="#" class="navbar_item navbar_item--dropdown">Earrings</a>
                        <a href="#" class="navbar_item navbar_item--dropdown">Bracelets</a>
                        <a href="#" class="navbar_item navbar_item--dropdown">Rings</a>
                        <a href="#" class="navbar_item navbar_item--dropdown">Exclusive Sets</a>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
</header>
</div>
<div>
@include('partials.footer')
</div>
</div>