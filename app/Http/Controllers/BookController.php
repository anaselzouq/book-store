<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{

    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        $books = $query->get();

        return view('books.public', compact('books'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }


    public function adminIndex(Request $request)
    {
        $query = Book::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        $books = $query->get();

        return view('books.index', compact('books'));
    }



    public function create()
    {
        return view('books.insert');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'published_date' => 'required|numeric|digits:4',
            'sub_category' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            'price' => 'required|numeric|min:0',
        ]);

        $imageName = time() . '.' . $request->img->extension();
        $request->img->move(public_path('uploads'), $imageName);

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'published_date' => $request->published_date,
            'sub_category' => $request->sub_category,
            'rating' => $request->rating,
            'thumbnail' => $imageName,
            'price' => $request->price,
        ])->save();

        return redirect()->route('admin.books')->with('success', 'The book has been added successfully!');
    }


    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }


    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'published_date' => 'required|numeric|digits:4',
            'sub_category' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'price' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('uploads'), $imageName);
            $book->thumbnail = $imageName;
        }

        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->published_date = $request->published_date;
        $book->sub_category = $request->sub_category;
        $book->rating = $request->rating;
        $book->price = $request->price;

        $book->save();

        return redirect()->route('admin.books')->with('success', 'The book has been successfully modified!');
    }


    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        $imagePath = public_path('uploads/' . $book->thumbnail);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $book->delete();

        return redirect()->route('admin.books')->with('success', 'The book has been successfully deleted!');
    }

    public function addToCart($id)
    {

        $book = \App\Models\Book::findOrFail($id);

        $cart = session()->get('cart', []);


        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "title" => $book->title,
                "price" => $book->price,
                "thumbnail" => $book->thumbnail,
                "quantity" => 1,
                "author" => $book->author,
                "id" => $book->id
            ];
        }

        session()->put('cart', $cart);


        $cartCount = collect($cart)->sum('quantity');


        return response()->json([
            'status' => 'success',
            'cartCount' => $cartCount
        ]);
    }

    public function removeFromCart($id, Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('cart');
    }
    public function updateCart($id, Request $request)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, (int)$request->quantity);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query || trim($query) == '') {
            return redirect('/')->with('not_found', 'يرجى إدخال كلمة للبحث.');
        }

        $query = mb_strtolower($query);

        $books = Book::whereRaw('LOWER(title) LIKE ?', ["%$query%"])
            ->orWhereRaw('LOWER(author) LIKE ?', ["%$query%"])
            ->get();

        if ($books->isEmpty()) {
            return redirect('/')->with('not_found', 'الكتاب غير متوفر حالياً.');
        }

        return view('books.search_results', compact('books', 'query'));
    }
}
