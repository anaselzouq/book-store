@extends('layouts.footer')
@extends('layouts.nav')

@section('content')

<h1 class="text-center mt-5 mb-5">جميع الروايات</h1>
<section class="books mt-4">
    <div class="container-fluid">
        <div class="mb-4 d-flex align-items-center another-nav small text-muted">
            <a href="{{ route('books.index') }}" class="me-2 text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> الرئيسية</a>
            <i class="fa-solid fa-angle-left mx-2"></i>
            <span>جميع الروايات</span>
        </div>
        <div class="row ms-4">
            @foreach ($books as $book)
            <div class="cart col-lg-4">
                <div class="img">
                    <a href="/book/{{ $book->id }}"><img src="uploads/{{ $book->thumbnail }}" alt="{{ $book->title }}" class="img-fluid"></a>
                </div>
                <div class="content">
                    <div class="text p-3">
                        <h5 class="mt-3 text-center mb-3"><a href="#">{{ $book->title }}</a></h5>
                        <p class="text-center">{{ $book->author }}</p>
                    </div>
                    <div onclick="addToCart({{ $book->id }}, this)" class="sal pb-2 d-flex align-items-center justify-content-evenly">
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

@endsection
</body>
</html>


