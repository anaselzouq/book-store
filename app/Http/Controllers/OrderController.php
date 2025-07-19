<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'governorate' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|string|in:cod',
        ]);

        $name = $request->first_name . ' ' . $request->last_name;


        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('book')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'السلة فارغة.');
        }

        $discount = 36;
        $total = 0;
        foreach ($cartItems as $item) {
            $priceAfterDiscount = round(($item->book->price + 50) * (1 - $discount / 100));
            $total += $priceAfterDiscount * $item->quantity;
        }

        $order = Order::create([
            'user_id' => $user->id,
            'name' => $name,
            'city' => $request->city,
            'governorate' => $request->governorate,
            'address' => $request->address,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'total_price' => $total,
        ]);

        foreach ($cartItems as $item) {
            $priceAfterDiscount = round(($item->book->price + 50) * (1 - $discount / 100));

            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $item->book->id,
                'quantity' => $item->quantity,
                'price' => $priceAfterDiscount,
            ]);
        }

        Cart::where('user_id', $user->id)->delete();

        if ($user->email) {
            Mail::to($user->email)->send(new OrderPlaced($order));
        }

        return redirect()->route('orders.thankyou')->with('success', 'تم تقديم الطلب بنجاح!');
    }
    public function myOrders()
    {
        $orders = Order::where('user_id', auth()->id())->with('orderItems.book')->latest()->get();
        return view('orders.mine', compact('orders'));
    }
    public function adminOrders()
    {
        $orders = Order::with('user', 'orderItems.book')->latest()->get();
        return view('orders.index', compact('orders'));
    }
}
