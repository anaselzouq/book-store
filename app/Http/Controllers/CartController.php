<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Book $book)
    {
        $user = Auth::user();

        $existing = Cart::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->first();

        if ($existing) {
            $existing->increment('quantity');
        } else {
            Cart::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'quantity' => 1
            ]);
        }

        $cartCount = Cart::where('user_id', $user->id)->sum('quantity');

        return response()->json([
            'status' => 'success',
            'cartCount' => $cartCount
        ]);
    }


    public function index()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('book')->get();

        return view('cart.index', compact('cartItems'));
    }

    public function remove($id)
    {
        $user = Auth::user();
        Cart::where('user_id', $user->id)->where('book_id', $id)->delete();

        return redirect()->back();
    }

    public function clear()
    {
        $user = Auth::user();
        Cart::where('user_id', $user->id)->delete();

        return redirect()->back();
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        return back()->with('success', 'تم تحديث الكمية بنجاح');
    }

    public function checkout()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('book')->get();

        $totalBeforeDiscount = 0;
        $totalAfterDiscount = 0;
        $discount = 36;

        foreach ($cartItems as $item) {
            $priceAfterDiscount = round(($item->book->price + 50) * (1 - $discount / 100));
            $totalBeforeDiscount += ($item->book->price * $item->quantity);
            $totalAfterDiscount += ($priceAfterDiscount * $item->quantity);
        }

        return view('cart.checkout', compact('cartItems', 'totalBeforeDiscount', 'totalAfterDiscount'));
    }
}
