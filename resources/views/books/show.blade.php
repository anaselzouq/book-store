@extends('layouts.footer')
@extends('layouts.nav')

@section('content')

<div class="container-lg py-5">

    <div class="mb-4 d-flex align-items-center another-nav small text-muted">
        <a href="{{ route('books.index') }}" class="me-2 text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> الرئيسية</a>
        <i class="fa-solid fa-angle-left mx-2"></i>
        <span>{{ $book->title }}</span>
    </div>


    <div class="row information-book g-4">

        <div class="col-md-4 text-center">
            <img src="{{ asset('uploads/' . $book->thumbnail) }}" alt="{{ $book->title }}" class="img-fluid rounded shadow-sm" style="max-height: 400px; object-fit: contain;">
        </div>


        <div class="col-md-8">
            <h2 class="mb-2">{{ $book->title }}</h2>
            <p class="text-muted mb-1">✍️ <strong>المؤلف:</strong> {{ $book->author }}</p>
            <p class="text-muted mb-3">⭐ <strong>التقييم:</strong> {{ $book->rating }} / 5</p>

            <div class="bg-light p-3 rounded mb-3">
                <p class="mb-0"><strong>نبذة عن الكتاب:</strong></p>
                <p class="text-muted small mb-0 mt-1">{{ $book->description }}</p>
            </div>

            <div class="bg-white p-3 rounded shadow-sm mb-3 border">
                <h4 class="text-success fw-bold">{{ $book->price }} ج.م</h4>
                <p class="text-muted small mb-1"><del>{{ $book->price + 54 }} ج.م</del> - خصم 20%</p>
                <p class="text-muted small mb-1">🚚 شحن مجاني للطلبات فوق 600 ج.م</p>
                <p class="text-muted small mb-0">🔒 تسوق آمن - بياناتك محمية دائمًا</p>
            </div>

            <button onclick="addToCart({{ $book->id }}, this)" class="btn btn-success btn-lg">
                <i class="fas fa-shopping-cart me-2"></i> أضف إلى السلة
            </button>
        </div>
    </div>
</div>

</body>

</html>
@endsection
