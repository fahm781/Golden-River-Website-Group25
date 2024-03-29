<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Address;
use Illuminate\Support\HtmlString;

class BasketController extends Controller
{
    public function addToBasket(Request $request){
        //dd(Order::where('Account_ID', Auth::user()->id)->where('Order_Status', 'Basket')->first()->Order_ID);
    if (!Auth::check()) {
        return redirect()->back()->with('loginToAddCart', new HtmlString('You need to <a href="/login" style="color:#842029">Login</a> to add to Cart'));
    }

        $productPrice = Product::where('Product_ID', $request->Product_ID)
        ->value('Product_Price');

          //checks first if address record exists, if it doesnt then make one
                 Address::firstOrCreate([
                'Account_ID' => Auth::user()->id,
                ], [
                'Account_ID' => Auth::user()->id,
                'ZIP' => "pending",
                'City' => "pending",
                'Country' => "pending",
                'Street' => "pending",
                'County' => "pending",
                ]);

        $address = Address::where('Account_ID', Auth::user()->id)->first();

        // Check if order exists in the database. If so, only increase the Order_Total_Price.
        $basketE = Order::where('Account_ID', Auth::user()->id)
        ->where('Order_Status', 'Basket')
        ->first();

    if (!$basketE) {
        // Create a new order if it doesn't exist
        $order = new Order;
        $order->Account_ID = Auth::user()->id;
        $order->Address_ID = $address->Address_ID;
        $order->Order_Status = 'Basket';
        $order->Order_Total_Price = $productPrice * $request->qty;
        $order->save();
    } else {
        // Update the existing order
        $basketE->increment('Order_Total_Price', $productPrice * $request->qty);
        $basketE->update();
        $order = $basketE;
        }

        // Check if the product already exists in the basket
        $orderItem = OrderItem::where('Order_ID', $order->Order_ID)
        ->where('Product_ID', $request->Product_ID)
        ->first();

    if (!$orderItem) {
            // Add the product to the basket if it doesn't exist
            $orderItem = new OrderItem;
            $orderItem->Product_ID = $request->Product_ID;
            $orderItem->Order_ID = $order->Order_ID;
            $orderItem->Amount = $request->qty;
            $orderItem->Price = $productPrice;
            $orderItem->save();
    } else {
            // Update the quantity of the product in the basket
            $orderItem->increment('Amount', $request->qty);
            $orderItem->update();
    }
    return redirect()->back()->with('addcartmsg', 'Product added to Basket');

    }

    public function showCart()
    {
        if (!auth()->check()) {          //checks if the user is authenticated if not then they will be redirected to the login page
            return redirect('login');
        }
        // Retrieve user basket
        $order = Order::where('Account_ID', auth()->user()->id)
            ->where('Order_Status', 'Basket')
            ->first();

        if (!$order) {
            return view('cart', ['products' => null]);
        }

        // Retrieve user products
        $products = $order->products;

           // Check if products are still in stock
        foreach ($products as $product) {
            if ($product->Amount < 1) {
                $order->products()->detach($product->Product_ID);

                $removedProductPrice = $product->Product_Price * $product->pivot->Amount;
                $order->Order_Total_Price -= $removedProductPrice;
                $order->save();

                session()->flash('cartstockmsg', 'Product ' . $product->Product_Name . ' is no longer available and has been removed from your basket.');
            }
        }

        //AddressID is the same as UserID
        $address = Address::where('Account_ID', Auth::user()->id)->first();

        $shippingCost = config('shipping.shipping_cost');

        return view('cart', [
            'products' => $products,
            'order' => $order,
            'address' => $address,
            'shippingCost' => $shippingCost,
        ]);
    }

    public function removeBasket($id)
    {
    $order = Order::where('Account_ID', Auth::user()->id)
    ->where('Order_Status', 'Basket')
    ->first();

    $orderItem = OrderItem::where('Order_ID', $order->Order_ID)
    ->where('Product_ID', $id)
    ->first();

   //to subtract the price of the deleted order item from the order's total price
   $order->Order_Total_Price -= $orderItem->Price * $orderItem->Amount;
   $order->save();

   // Delete the order item
   $orderItem->delete();

   return redirect('/cart')->with('rmvcartmsg', "Item Removed");
    }
public function test()
{
dd(session()->get('user.Phone_Number'));
}

}
