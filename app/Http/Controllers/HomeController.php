<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $books = [];
        $query = $request->input('q');

        if ($query) {
            $books = Book::where('title', 'like', "%$query%")
                ->orWhere('author', 'like', "%$query%")
                ->get();
        }

        return view('books.public', compact('categories', 'books', 'query'));
    }

    public function cart()
    {
        $cart = session('cart', []);
        return view('books.cart', compact('cart'));
    }

    public function romanticBooks()
    {
        $books = Book::all();
        return view('books.categories.romantic', compact('books'));
    }

    public function imaginationBooks()
    {
        $books = Book::all();
        return view('books.categories.imagination', compact('books'));
    }

    public function fantasyBooks()
    {
        $books = Book::all();
        return view('books.categories.fantasy', compact('books'));
    }
    public function horrorBooks()
    {
        $books = Book::all();
        return view('books.categories.horror', compact('books'));
    }

    public function suspenseBooks()
    {
        $books = Book::all();
        return view('books.categories.suspense', compact('books'));
    }
    public function crimeBooks()
    {
        $books = Book::all();
        return view('books.categories.crime', compact('books'));
    }
    public function socialBooks()
    {
        $books = Book::all();
        return view('books.categories.social', compact('books'));
    }

    public function historicalBooks()
    {
        $books = Book::all();
        return view('books.categories.historical', compact('books'));
    }
    public function dramaticBooks()
    {
        $books = Book::all();
        return view('books.categories.dramatic', compact('books'));
    }
    public function subjectiveBooks()
    {
        $books = Book::all();
        return view('books.categories.subjective', compact('books'));
    }
    public function allNovels()
    {
        $books = Book::all();
        return view('books.categories.all_novels', compact('books'));
    }
}
