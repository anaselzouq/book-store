@extends('layouts.footer')
@extends('layouts.nav')

@section('content')
    <div class="container my-5">

        @livewire('book-search-hero')

        @if($books->count() > 0)
            <section class="books">
                <div class="container-lg">
                    <div class="row mb-5">
                        @foreach ($books as $book)
                            <div class="cart col-lg-2 col-md-4 col-sm-6 col-12">
                                <div class="img">
                                    <a href="/book/{{ $book->id }}"><img src="uploads/{{ $book->thumbnail }}"
                                            alt="{{ $book->title }}" class="img-fluid"></a>
                                </div>
                                <div class="content">
                                    <div class="text p-3">
                                        <h5 class="mt-3 text-center mb-3"><a href="#">{{ $book->title }}</a></h5>
                                        <p class="text-center">{{ $book->author }}</p>
                                    </div>
                                    <div onclick="addToCart({{ $book->id }}, this)"
                                        class="sal pb-2 d-flex align-items-center justify-content-evenly">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span class="last-price">{{ $book->price + 50 }} ج.م</span>
                                        <span class="new-price">{{ $book->price }} ج.م</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @else
            <p class="text-center">لا توجد نتائج تطابق البحث.</p>
        @endif
    </div>
    </body>

    </html>
@endsection
